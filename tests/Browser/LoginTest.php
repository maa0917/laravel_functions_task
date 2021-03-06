<?php

namespace Tests\Browser;

use App\Mail\UserMailer;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     * @throws Throwable
     */
    public function profile_imageカラムに対して画像を登録されるようにフォームが生成されていること()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('users.create');
            $browser->assertPresent('input[name="profile_image"]');
        });
    }

    /**
     * @test
     * @throws Throwable
     */
    public function アカウント登録時にプロフィール画像を登録できること()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('users.create');
            $browser->value('#user_name', 'sample');
            $browser->value('#user_email', 'user@gmail.com');
            $browser->value('#user_password', 'password');
            $browser->value('#user_password_confirmation', 'password');
            $browser->attach('profile_image', __DIR__ . '/images/スクリーンショット 2021-01-08 18.33.25.png');
            $browser->click('#submit');

            $browser->assertSee('アカウントを登録しました');
        });
    }

    /**
     * @test
     * @throws Throwable
     */
    public function プロフィール画像を選択してユーザ登録した際、詳細画面に遷移させ、プロフィール画像を表示されること()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('users.create');
            $browser->value('#user_name', 'sample');
            $browser->value('#user_email', 'user@gmail.com');
            $browser->value('#user_password', 'password');
            $browser->value('#user_password_confirmation', 'password');
            $browser->attach('profile_image', __DIR__ . '/images/スクリーンショット 2021-01-08 18.33.25.png');
            $browser->click('#submit');

            $user = User::where('email', 'user@gmail.com')->first();
            $browser->assertPathIs("/users/{$user->id}");

            $path = asset(Storage::disk('local')->url($user->profile_image));
            $browser->assertPresent("img[src='$path']");
        });
    }

    /**
     * @test
     * @throws Throwable
     */
    public function プロフィール画像を選択せずにユーザ登録した際、エラーを発生させずに詳細画面に遷移させること()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('users.create');
            $browser->value('#user_name', 'sample');
            $browser->value('#user_email', 'user@gmail.com');
            $browser->value('#user_password', 'password');
            $browser->value('#user_password_confirmation', 'password');
            $browser->click('#submit');

            $user = User::where('email', 'user@gmail.com')->first();
            $browser->assertPathIs("/users/{$user->id}");
        });
    }

    /**
     * @test
     * @throws Throwable
     */
    public function アカウント登録した際、そのユーザにメールを送信すること()
    {
        $this->browse(function (Browser $browser) {
            Mail::fake();
            Mail::assertNothingSent();

            $this->post('/users', [
                'name' => 'sample',
                'email' => 'user@gmail.com',
                'password' => 'password',
                'password_confirmation' => 'password',
            ]);

            Mail::assertQueued(UserMailer::class, function ($mail) {
                $mail->build();

                return $mail->hasTo('user@gmail.com');
            });
        });
    }

    /**
     * @test
     * @throws Throwable
     */
    public function 要件で指定したメール文章が送信されていること()
    {
        $this->browse(function (Browser $browser) {
            Mail::fake();
            Mail::assertNothingSent();

            $this->post('/users', [
                'name' => 'sample',
                'email' => 'user@gmail.com',
                'password' => 'password',
                'password_confirmation' => 'password',
            ]);

            Mail::assertQueued(UserMailer::class, function ($mail) {
                $mail->build();

                return $mail->subject === '登録完了';
            });
        });
    }

    /**
     * @test
     * @throws Throwable
     */
    public function Jobを実装し、非同期でメールを送信すること()
    {
        $this->browse(function (Browser $browser) {
            Mail::fake();
            Mail::assertNothingSent();

            $this->post('/users', [
                'name' => 'sample',
                'email' => 'user@gmail.com',
                'password' => 'password',
                'password_confirmation' => 'password',
            ]);

            Mail::assertQueued(UserMailer::class);
        });
    }
}
