<?php

namespace CBFieldsVendor\WPDesk\PluginBuilder\Plugin;

interface Hookable
{
    /**
     * Init hooks (actions and filters).
     *
     * @return void
     */
    public function hooks();
}
