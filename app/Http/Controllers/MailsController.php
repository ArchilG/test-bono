<?php

namespace App\Http\Controllers;

use App\Exports\MessagesExport;
use App\Models\Message;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * @OA\Info(
 *     title="Messages Doc API",
 *     version="1.0"
 * ),
 * @OA\PathItem(
 *     path="/"
 * )
 * @OA\Get(
 *     path="/mails",
 *     summary="Mails list",
 *     tags={"Messages list"},
 *
 *     @OA\RequestBody(
 *         @OA\JsonContent(
 *             allOf={
 *                 @OA\Schema(
 *                     @OA\Property(property="order", type="string", example="asc", description="Sort direction")
 *                 )
 *             }
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Ok",
 *         @OA\JsonContent(
 *             @OA\Property(property="",type="array", @OA\Items(
 *                 @OA\Property(property="name", type="string"),
 *                 @OA\Property(property="email", type="string"),
 *             )),
 *         )
 *
 *     ),
 * )
 */
class MailsController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function form()
    {
        return view('form');
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     * @throws ValidationException
     */
    public function list(Request $request)
    {
        $this->validate($request, [
            'order' => 'string|in:asc,desc',
        ]);
        $order = $request->get('order', 'desc');
        $items = Message::orderBy('created_at', $order)->select(['id', 'name', 'email'])->paginate(10);
//        $items = Message::orderBy('created_at', $order)->select(['name', 'email'])->paginate(10)->each(function ($item) {
//            return $item;
//        });
//        return response($items);
        return view('list', compact('items', 'order'));
    }

    /**
     * @param $id
     * @return Application|Factory|View
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function detail($id)
    {
        $fields = request()->get('fields', ['name', 'email']);
        $message = Message::select(array_merge($fields, ['id', 'text', 'created_at']))->first($id);
        if (empty($message)) {
            abort(404);
        }
//        return response($message);
        return view('detail', compact('message'));
    }

    /**
     * @return BinaryFileResponse
     */
    public function excelExport(): BinaryFileResponse
    {
        return Excel::download(new MessagesExport, 'messages.xlsx');
    }

    /**
     * @param Request $request
     * @return Application|ResponseFactory|Response
     * @throws ValidationException
     */
    public function send(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|string',
            'text' => 'required|string',
        ]);
        try {
            $user = User::where('email', $request->get('email'))->first();
            $id = Message::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'text' => $request->get('text'),
                'registered' => !empty($user),
                'user_id' => $user->id ?? null
            ])->id;
        } catch (\Throwable $e) {
            return response([
                'error' => $e->getMessage()
            ], 500);
        }

        return response([
            'id' => $id
        ], 200);
    }
}
