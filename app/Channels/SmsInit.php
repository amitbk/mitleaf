<?php

namespace App\Channels;

class SmsInit
{
    /**
     * The post view.
     *
     * @var string
     */
    protected $view;

    /**
     * Additional post parameters.
     *
     * @var array
     */
    protected $params = [];

    /**
     * Create a new post instance.
     *
     * @param  string  $view
     * @return void
     */
    public function __construct($view = null)
    {
        $this->view = $view;
    }

    /**
     * Set the post view.
     */
    public function withView(?string $view, ?array $params = [])
    {
        $this->view = $view;
        $this->params = $params;

        return $this;
    }

    /**
     * Get the post view.
     */
    public function getView(): ?string
    {
        return $this->view;
    }

    /**
     * Set the post params.
     */
    public function withParams(array $params)
    {
        $this->params = $params;

        return $this;
    }

    /**
     * Get the post params.
     */
    public function getParams(): array
    {
        return $this->params;
    }
}
