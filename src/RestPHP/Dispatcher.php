<?php
/**
 * RestPHP Framework
 *
 * PHP Version 5.3
 *
 * Copyright (c) 2011, RestPHP Framework
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * Redistributions of source code must retain the above copyright notice,
 * this list of conditions and the following disclaimer.
 *
 * Redistributions in binary form must reproduce the above copyright notice,
 * this list of conditions and the following disclaimer in the documentation
 * and/or other materials provided with the distribution.
 *
 * Neither the name of the RestPHP Framework nor the names of its contributors
 * may be used to endorse or promote products derived from this software
 * without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @category   RestPHP
 * @package    RestPHP
 * @author     Joshua Johnston <johnston.joshua@gmail.com>
 * @copyright  2011 RestPHP Framework
 * @license    http://opensource.org/licenses/bsd-license.php New BSD License
 */
/**
 * @namespace
 */

namespace RestPHP;

/**
 * Dispatcher
 *
 * @category   RestPHP
 * @package    RestPHP
 * @author     Joshua Johnston <johnston.joshua@gmail.com>
 * @copyright  2011 RestPHP Framework
 * @license    http://opensource.org/licenses/bsd-license.php New BSD License
 */
class Dispatcher
{
    /**
     * The application config
     *
     * @var Config
     */
    protected $config;

    /**
     * Application router
     *
     * @var Router
     */
    protected $router;

    /**
     * Creates the Dispatcher
     *
     * @param Config $config
     * @return Dispatcher
     */
    public function __construct(Config $config = null)
    {
        if ($config) {
            $this->setConfig($config);
        }
    }

    /**
     * Gets the current config
     *
     * @return Config
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Sets the current config
     *
     * @param Config $config
     */
    public function setConfig(Config $config)
    {
        $this->config = $config;
    }

    public function getRouter()
    {
        if (!$this->router) {
            $this->router = new Router($this->getConfig());
        }

        return $this->router;
    }

    public function setRouter($router)
    {
        $this->router = $router;
    }

    /**
     *
     * @param Request\Request $request
     * @return Response\Response
     */
    public function dispatch(Request\Request $request)
    {
        $router = $this->getRouter();
        $resource = $router->route($request);
        return $resource->execute();
    }
}