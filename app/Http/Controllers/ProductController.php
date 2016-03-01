<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\CreateProductRequest;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use File;
use Input;
use Session;

class ProductController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $code = $request->input('code');
        $products = Product::where('code', 'LIKE', '%' . $code . '%')->paginate(30);
        return view('products.index', compact('products', 'code'));
    }

    public function import(Request $request)
    {
        return view('products.import');
    }

    /**
     * @param Requests\CreateProductRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateProductRequest $request)
    {
        $product = Product::create($request->all());
        return response()->json(["status" => "OK", "product" => $product]);
    }

    public function getCheck() {
        return view('products.check');
    }

    public function check(Request $request)
    {
        $matchThese = ['code' => $request->input('code'), 'style' => $request->input('style'), 'measure'=>$request->input('measure')];
        $product = Product::where($matchThese)->first();
        return response()->json(['confirmado'
            =>$product ? 'Producto confirmado.' : 'Producto no confirmado']);
    }

    /**
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Request $request, Product $product)
    {
        $product->delete();
//        return response()->json(["status" => "OK", "messages" => ["message" => "Producto eliminado"]]);
        return redirect('/products')->with('message', $product->code . ' ha sido eliminado.');
    }

    /**
     * @param Request $request
     * @param $code
     * @param int $limit
     * @return mixed
     */
    public function searchProducts(Request $request, $code, $limit = 20)
    {
        return Product::where('code', 'LIKE', '%' . $code . '%')->paginate($limit);
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse|null|\Symfony\Component\HttpFoundation\File\UploadedFile
     */
    public function importSheets(Request $request)
    {
        $folder = '../uploads/';

        $this->createUploadFolder($folder);

        // Validar si se recibe un archivo
        if (empty($_FILES['file'])) {
//            return response()->json(['status' => 'error', "messages" => ['message' => 'No se recibio ningún archivo']]);
            return redirect()->back()->withErrors(['No se recibio ningun archivo']);
        }

        // Informacion del archivo
        $file = $_FILES['file'];
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $fileName = pathinfo($file['name'], PATHINFO_FILENAME);

        // Validar que la extension sea xlsx
        if ($ext !== 'xlsx') {
//            return response()->json(['status' => 'error', "messages" => ['message' => 'Solo se permite importar archivos .xlsx']]);
            return redirect()->back()->withErrors(['Solo se permite importar archivos .xlsx']);
        }

        $today = date('Y-m-d_H-i-s');
        $fileName = "{$fileName}_{$today}.{$ext}";
        // Mover el archivo a la carpeta upload
        move_uploaded_file($file['tmp_name'], $folder . $fileName);
        // Obtener las filas del archivo
        $sheets = Excel::load($folder . $fileName, function ($reader) {
        })->get();
        // Borrar el archivo luego de haberlo usado
        unlink($folder . $fileName);
        // Retornar la cantidad de registros nuevos de la base de datos
        $response = $this->saveSheet($sheets) . ' productos nuevos importados.';
        return redirect('/products')->with('message', $response);
    }

    /**
     * @param $reader
     * @return array
     */
    private function saveSheet($reader)
    {
        $rows = $reader->all();
        $count = 0;
        foreach ($rows as $row) {
            $product = Product::where('code', 'LIKE', $row->orden_n)->first();
            if (!$product) {
                $count++;
                $product = new Product(['code' => $row->orden_n, 'style' => $row->nombre, 'measure' => $row->medida]);
                $product->save();
            }
        }
        return $count;
    }

    private function createUploadFolder($folder)
    {
        if (!is_dir($folder)) {
            mkdir("../uploads", 0777);
        }
    }
}
