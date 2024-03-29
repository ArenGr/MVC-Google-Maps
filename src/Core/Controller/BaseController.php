<?php

namespace App\Core\Controller;

use App\Core\View\View;

class BaseController implements BaseControllerInterface
{
    /**
     * @param View $view
     */
    public function __construct(public View $view)
    {
    }

    /**
     * @param string $name
     * @param array $data
     * @return void
     * @throws \Exception
     */
    public function renderView(string $name, array $data): void
    {
        $this->view->render($name, $data);
    }

    /**
     * @param $data
     * @return void
     */
    public function renderJsonResponse(array $data): void
    {
        $json = json_encode($data);
        if ($json === false) {
            throw new \RuntimeException('Error encoding JSON');
        }

        header('Content-Type: application/json');
        echo $json;
        die();
    }
}
