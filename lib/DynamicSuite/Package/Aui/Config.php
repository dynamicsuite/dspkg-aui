<?php
/*
 * Aui Package
 * Copyright (C) 2020 Dynamic Suite Team
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation version 3.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software Foundation,
 * Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301  USA
 */

namespace DynamicSuite\Package\Aui;
use DynamicSuite\DSConfig;

/**
 * Class Config.
 *
 * @package DynamicSuite\Package\Aui
 * @property bool $use_minified
 */
class Config extends DSConfig
{

    /**
     * Use the minified version.
     *
     * @var string
     */
    protected $use_minified = true;

    /**
     * Config constructor.
     *
     * @param string $package_id
     * @return void
     */
    public function __construct(string $package_id)
    {
        parent::__construct($package_id);
    }

}