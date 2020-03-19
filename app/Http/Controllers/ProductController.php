<?php


namespace App\Http\Controllers;


use App\Model\Product;
use App\Presentation\ProductDetail;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    const ITEMS_PER_PAGE = 25;

    public function index()
    {
        $pagination = Product::query()
            ->orderBy('name')->paginate(self::ITEMS_PER_PAGE);

        $products = $pagination->items();

        $items = [];
        foreach ($products as $product) {
            /* @var Product $product */
            $items[] = ProductDetail::make($product, $product->vendor);
        }

        $links = $pagination->links();

        return view('product.list',
            ['list' => $items, 'pagination' => $links]);
    }

    public function store(Request $request, string $id)
    {
        $parameters = $request->all();
        $price = (int)($parameters['price'] ?? 0);

        $identity = (int)$id;
        $isValid = $price > 0 && $identity > 0;

        $code = '❌';
        $isSuccess = false;
        if ($isValid) {
            /* @var Product $product */
            $product = Product::query()->find($identity);
            $product->price = $price;

            $isSuccess = $product->save();
        }
        if ($isSuccess) {
            $code = '✅';
        }
        $result = json_encode(['result' => $code]);

        return $result;
    }
}