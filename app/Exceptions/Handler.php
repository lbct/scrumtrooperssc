<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
        ModelNotFoundException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        /*if ($e instanceof ModelNotFoundException) {
            $e = new NotFoundHttpException($e->getMessage(), $e);
            return parent::render($request, $e);
        }*/

        if ($this->isHttpException($e)) {
            switch ($e->getStatusCode()) {
    
                // not authorized
                case '403':
                    $request->session()->flash('alert-info', 'No tiene permiso de acceder a la pagina');
                    return redirect('login');
                    break;
    
                // not found
                case '404':
                    $request->session()->flash('alert-info', 'La pagina no existe');
                    return redirect('login');
                    break;
    
                // internal error
                case '500':
                    $request->session()->flash('alert-info', 'La pagina no "existe"');
                    return redirect('login');
                    break;
    
                default:
                    return $this->renderHttpException($e);
                    break;
            }
        } else {
            return parent::render($request, $e);
        }
        
    }
}
