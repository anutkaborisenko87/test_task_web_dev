<?php

namespace TestWebDev\src;

class View
{
    /**
     * @var string
     */
    protected $layout = 'app';

    /**
     * @param $view
     * @param $data
     * @return void
     */
    public function render($view, $data = [])
    {
        $layout = $this->getLayout($data);
        $content = $this->getContent($view, $data);
        $output = str_replace('{{ content }}', $content, $layout);

        echo $output;
    }

    /**
     * @param string $view
     * @param array $data
     * @return false|string
     */

    public function getContent(string $view, array $data = [])
    {
        extract($data);
        ob_start();
        if (file_exists(ROOT . '/resourses/views/' . $view . '.php')) {
            require_once ROOT . '/resourses/views/' . $view . '.php';
        }
        return ob_get_clean();
    }

    /**
     * @param array $data
     * @return false|string
     */
    public function getLayout(array $data = [])
    {
        extract($data);
        ob_start();

        if (file_exists(ROOT . '/resourses/layouts/' . $this->layout . '.php')) {
            require_once ROOT . '/resourses/layouts/' . $this->layout . '.php';
        }

        return ob_get_clean();
    }

    /**
     * @param $layout
     * @return void
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }
}