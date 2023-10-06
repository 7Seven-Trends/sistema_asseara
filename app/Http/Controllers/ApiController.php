<?php

namespace App\Http\Controllers;

use App\Models\Leads;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function leadAdd(Request $request)
    {

        $rules = [
            'nome' => 'required|string|min:3|max:100',
            'email' => 'required|email|min:3|max:100',
            'telefone' => 'required|regex:/^\([1-9]{2}\) [2-9][0-9]{3,4}-[0-9]{4}$/',
            'message' => 'nullable|string|min:10|not_regex:/<[^>]*>/'
        ];

        $messages = [
            'required' => 'O campo :attribute é obrigatório.',
            'min' => 'O campo :attribute deve ter pelo menos :min caracteres.',
            'max' => 'O campo :attribute não pode ter mais de :max caracteres.',
            'email' => 'O campo :attribute deve ser um endereço de e-mail válido.',
            'regex' => 'O formato do campo :attribute é inválido.',
            'not_regex' => 'O campo :attribute não pode conter código HTML.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {

            $errorMessages = [];
            foreach ($validator->errors()->messages() as $field => $messages) {
                $errorMessages[] = implode(", ", $messages);
            }

            return response()->json([
                'code' => 422,
                'return' => false,
                'msg' => implode('<br/>', $errorMessages),
                'errors' => $validator->errors()
            ], 422);
        }

        $leads = new Leads;
        $leads->nome = $request->nome;
        $leads->email = $request->email;
        $leads->telefone = $request->telefone;
        $leads->message = empty($request->message) ? 'NULL' : $request->message;
        $leads->save();
    
        return response()->json([
            'code' => 200,
            'return' => true,
            'msg' => 'Lead inserido com sucesso!',
        ], 200);
    }
}
