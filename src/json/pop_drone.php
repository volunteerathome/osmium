<?php
/* Osmium
 * Copyright (C) 2012 Romain "Artefact2" Dalmaso <artefact2@gmail.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Osmium\Json\PopDrone;

require __DIR__.'/../../inc/root.php';
require __DIR__.'/../../inc/ajax_common.php';

if(!\Osmium\State\is_logged_in()) {
	\Osmium\Chrome\return_json(array());
}


if(isset($_GET['token']) && $_GET['token'] == \Osmium\State\get_token()) {
	$fit = \Osmium\State\get_state('new_fit', array());
	$typeid = intval($_GET['typeid']);
	$from = $_GET['from'];
	\Osmium\Fit\remove_drone($fit, $typeid, $from);
	\Osmium\State\put_state('new_fit', $fit);
	\Osmium\Chrome\return_json(\Osmium\AjaxCommon\get_data_step_drone_select($fit));
} else {
	\Osmium\Chrome\return_json(array());
}
