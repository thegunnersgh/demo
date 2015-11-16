<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;

class RedirectIfAuthenticated {

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * Create a new filter instance.
	 *
	 * @param  Guard  $auth
	 * @return void
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if ($this->auth->check())
		{
			// tìm hiểu cái này RedirectResponse
			// nó kiểm tra nếu đăng nhập rùi redirect đến home
			// ---  RedirectResponse nó có nhiều phương thức lắm tự dò rùi tìm hiểu xem
			// t đi tắm đây
			// cái đệt
			//thế có phải sai hay j ko?
			// ko phải sai. mà nó check vậy. để đăng nhập rùi thì ko vào trang login được nữa
			// nếu vào nó sẽ chuyển đến trang chủ của web
			// à thôi, ok
			// nhưng chuyển home thanh auth/login nó sẽ thành trạng thái lặp vô điều kiện
			// vì nó kiểm tra nếu có tk thì nó lại redirect tới auth/login rùi cứ lặp lại như thế ==> ko vào được trang auth/login
			return new RedirectResponse(url('/home'));
			//thôi hiểu rồi
			// uhm
		}

		return $next($request);
	}

}
