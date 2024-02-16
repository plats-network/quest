<?php

namespace App\Http\Controllers\FrontendQuest\Auth;

use App\Models\User;
use App\Space\TelegramLoginAuth\Contracts\Telegram\NotAllRequiredAttributesException;
use App\Space\TelegramLoginAuth\Contracts\Validation\Rules\ResponseOutdatedException;
use App\Space\TelegramLoginAuth\Contracts\Validation\Rules\SignatureException;
use App\Space\TelegramLoginAuth\TelegramLoginAuth;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramAuthController
{
    /*
     * Telegram Auth Handle
     *
     * @created 2021/07/07
     * */
    public function handleTelegramCallback(TelegramLoginAuth $telegramLoginAuth, Request $request)
    {
        try {
            $user = $telegramLoginAuth->validateWithError($request);
            //Check has exits user
            //If not register => register => login

            $telegramId = $user->getId();
            $telegramFirstName = $user->getUsername();

            /** @var User $userModel */
            $userModel = User::query()
                ->where('telegram_id', $telegramId)
                ->first();

            //Todo check is admin

            //Has exits user
            if ($userModel) {
                //Login user
                //Log login history
                //Send flash login success message
                $request->session()->flash('success', 'Đăng nhập thành công.');

                return redirect(route('admin.homeAdmin', ['send_job' => 1]));
            } else {
                //Create new user
                $dataUserCreate = [
                    'name' => $telegramId,
                    'first_name' => $telegramFirstName,
                    //'last_name' => $user->getLastName(),
                    'email' => $telegramId.'@example.com',
                    'password' => $user->getHash(),
                    'is_guess' => 0,
                    'telegram_id' => $user->getId(),
                    //'token_api' => Str::random(16),
                ];

                $userCreate = User::create($dataUserCreate);

                //event(new Registered($userCreate));

                return redirect(route('quest.index'))->with('success', 'Đăng ký thành công. Vui lòng đăng nhập.');
            }

        } catch (NotAllRequiredAttributesException $e) {
            // ...
            Log::alert('Telegram Login Error: Not all require Attibute');
            //dd('12');
        } catch (SignatureException $e) {
            // ...
            //dd('12d');
            Log::alert('Telegram Login Error: Signature');
        } catch (ResponseOutdatedException $e) {
            // ...
            //dd('1sss2');
            Log::alert('Telegram Login Error: OutData');
        } catch (\Exception $e) {
            // ...
            //dd($e->getMessage());
            Log::alert('Telegram Login Error: OutData');
        }

        return redirect(route('admin.homeAdmin'))->with('success', 'User login!');
        // ...
    }


    /*
     * Connect database with Telegram
     * */
    public function handleTelegramCallbackData(TelegramLoginAuth $telegramLoginAuth, Request $request)
    {
        try {
            $telegramUser = $telegramLoginAuth->validateWithError($request);
            //Check has exits user
            //If not register => register => login

            $telegramId = $telegramUser->getId();
            $telegramFirstName = $telegramUser->getFirstName();
            /** @var User $user */
            $user = auth()->guard('admin')->user();

            //Has exits user
            if ($telegramId) {
                $idUser = $user->id;
                //Save telegram ID to user
                /** @var User $userModel */
                $userModel = User::query()
                    ->where('id', $user->id)
                    ->first();
                $userModel->telegram_id = $telegramId;

                Log::alert('Telegram Connect.');
                //session save time login
                $nowDate = Carbon::now();
                $request->session()->put('admin_login_datetime', $nowDate->toDateTimeString());

                $userModel->save();
            }

            return redirect(route('admin.homeAdmin'))->with('success', 'Thiết lập telegram thành công!');
        } catch (NotAllRequiredAttributesException $e) {
            // ...
            Log::alert('Telegram Login Error: Not all require Attibute');
            //dd('12');
        } catch (SignatureException $e) {
            // ...
            //dd('12d');
            Log::alert('Telegram Login Error: Signature');
        } catch (ResponseOutdatedException $e) {
            // ...
            //dd('1sss2');
            Log::alert('Telegram Login Error: OutData');
        } catch (\Exception $e) {
            // ...
            //dd($e->getMessage());
            Log::alert('Telegram Login Error: OutData');
        }

        return redirect(route('admin.homeAdmin'))->with('success', 'User login!');
        // ...
    }
}
