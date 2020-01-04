<?php

class View
{
    /**
     * Given template
     */
    private $template;

    public function __construct($template)
    {
        $this->template = $template;
    }

    /**
     * Renders view
     */
    public function render($data=['data'=>null])
    {
        extract($data);
        ob_start();
        include_once TEMPLATE_PATH . $this->template;
        $content = ob_get_contents();
        ob_end_clean();
        echo $content;
    }
}
