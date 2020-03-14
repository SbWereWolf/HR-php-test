<?php


namespace App\Http\Controllers;


use App\Model\Product;
use App\Presentation\ProductDetail;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class ProductController extends Controller
{
    const ITEMS_PER_PAGE = 25;

    public function index()
    {
        $current = Paginator::resolveCurrentPage('page') - 1;

        $products = Product::with(Product::VENDOR)
            ->orderBy('name')
            ->offset($current * self::ITEMS_PER_PAGE)
            ->limit(self::ITEMS_PER_PAGE)
            ->get()->all();

        $items = [];
        foreach ($products as $product) {
            /* @var Product $product */
            $items[] = ProductDetail::make($product, $product->vendor);
        }

        /* При использовании пагинации почему то перестаёт работать
           Product::with(Product::VENDOR),
           обращение к $product->vendor возвращает null,
           поэтому пагинация "дублируется" (как бы)
        */
        $paginate = ((Product::paginate(self::ITEMS_PER_PAGE))
            ->links());

        return view('product.list',
            ['list' => $items, 'paginate' => $paginate]);
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