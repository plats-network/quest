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

            //Get  telegram user
            $telegramId = $user->getId();
            $telegramUserName = $user->getUsername();
            //dd($telegramId, $telegramUserName);

            $telegramFirstName = $user->getUsername();

            /** @var User $questUser */
            $userLogin = auth()->guard('quest')->user();


            //Todo check is admin

            //Has exits user
            if ($userLogin->telegram_id) {
                //Login user
                //Log login history
                //Save telegram ID to user
                $userLogin->telegram_id = $telegramId;
                $userLogin->telegram_username = $telegramUserName;
                $userLogin->save();
                //Send flash login success message
                $request->session()->flash('success', 'Kết nối thành công!');

                return redirect(route('quest.users.profileEdit', ['id' => encode_id($userLogin->id)]));
            } else {
                //Save telegram ID to user
                $userLogin->telegram_id = $telegramId;
                $userLogin->telegram_username = $telegramUserName;
                $userLogin->save();
                //event(new Registered($userCreate));

                return redirect(route('quest.users.profileEdit', ['id' => encode_id($userLogin->id)]));
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

        return redirect(route('quest.users.profileEdit', ['id' => encode_id($userLogin->id)]));
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
