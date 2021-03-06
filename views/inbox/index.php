<?php
/**
 * OpenEyes
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2013
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2008-2011, Moorfields Eye Hospital NHS Foundation Trust
 * @copyright Copyright (c) 2011-2013, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */
?>

<h1 class="badge">Messages</h1>

<div class="box content">
	<div class="large-12 column">
		<div class="panel">

			<table class="grid" id="inbox-table">
				<thead>
				<tr>
                    <th>Priority</th>
					<th>Date</th>
					<th>Hospital ID</th>
					<th>Patient name</th>
					<th>DOB</th>
					<th>Message from</th>
					<th>Message</th>
					<th>Delete</th>
				</tr>
				</thead>
				<tbody>
                <?php
                if (count($messages)) {
                    foreach ($messages as $message) {
                        $this->renderPartial('message_row', array('message' => $message));
                    }
                } else {?>
                <tr>
                    <td colspan="8" style="text-align: center;">You have no messages at this time.</td>
                </tr>
                <?php } ?>
				</tbody>
			</table>

		</div>
	</div>
</div>