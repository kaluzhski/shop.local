<?php

namespace App\services\renderers;

class TemplateRenderer 
{
    public function render ($template, $params = [])
    {
        $content = $this->renderTemplate($template, $params);
        return $this->renderTemplate('layouts/main', ['content' => $content]);
    }

    protected function renderTemplate($template, $params = []) 
    {
        ob_start();
        extract($params);
        include dirname(__DIR__, 2) . '/views/' . $template . '.php';
        return ob_get_clean();
    }
}