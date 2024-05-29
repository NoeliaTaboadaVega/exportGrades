<?php
// Este archivo es parte de Moodle - https://moodle.org/
//
// Moodle es software libre: puede redistribuirlo y/o modificarlo
// bajo los términos de la Licencia Pública General de GNU publicada por
// la Free Software Foundation, ya sea la versión 3 de la Licencia, o
// (a su elección) cualquier versión posterior.
//
// Moodle se distribuye con la esperanza de que sea útil,
// pero SIN NINGUNA GARANTÍA; sin incluso la garantía implícita de
// COMERCIABILIDAD o APTITUD PARA UN PROPÓSITO PARTICULAR.  Vea los
// detalles de la Licencia Pública General de GNU para más detalles.
//
// Debería haber recibido una copia de la Licencia Pública General de GNU
// junto con Moodle. Si no, vea <https://www.gnu.org/licenses/>.

/**
 * Las cadenas del plugin se definen aquí.
 *
 * @package     mod_exportgrades
 * @category    string
 * @copyright   2024 Su Nombre <you@example.com>
 * @license     https://www.gnu.org/copyleft/gpl.html Licencia Pública General de GNU v3 o posterior
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'exportar-calificaciones-nube';

$string['exportgrades'] = 'Exportar Calificaciones';
$string['frequency'] = 'Frecuencia de Exportación';
$string['frequency_desc'] = 'Seleccione con qué frecuencia desea exportar las calificaciones a Google Drive.';
$string['daily'] = 'Diario';
$string['weekly'] = 'Semanal';
$string['monthly'] = 'Mensual';
$string['fileexported'] = 'El archivo ha sido exportado y subido exitosamente a Google Drive.';
$string['exportgradestask'] = 'Tarea de Exportar Calificaciones';
$string['drivefolderid'] = 'ID de Carpeta de Google Drive';
$string['drivefolderid_desc'] = 'El ID de la carpeta de Google Drive donde se subirán los archivos Excel exportados.';
$string['drivecredentials'] = 'Credenciales de la Cuenta de Servicio de Google Drive';
$string['drivecredentials_desc'] = 'Las credenciales JSON para la cuenta de servicio de Google Drive. Pegue el contenido JSON completo aquí.';
