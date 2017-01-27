<?php
/**
 * Preslovar Web.
 *
 * Backend for generating HTML on Preslovar.
 *
 * @package    dimadin\Preslovar
 * @subpackage HTML
 */

namespace dimadin\Preslovar;

// Define path as this file's directory
if ( ! defined( 'PRESLOVAR_PATH' ) ) {
	define( 'PRESLOVAR_PATH', dirname( __FILE__ ) . '/' );
}

// Load dependencies
require __DIR__ . '/vendor/autoload.php';

// Start execution
Main::load();
?>
<!DOCTYPE html>
<html lang="sr-RS">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Пресловар — Пресловљавање ћирилице у латиницу и обрнуто</title>
		<meta name="description" content="Брзо и лако пребацивање ћирилице у латиницу и латинице у ћирилицу">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php foreach ( Dependencies::$styles as $style ) : ?>
			<link rel="stylesheet" href="<?php echo $style; ?>">
		<?php endforeach; ?>
		<link rel="canonical" href="/" />
		<?php if ( Fields::$cyrillic_textarea ) : ?>
			<meta name='robots' content='noindex,nofollow' />
		<?php endif; ?>
	</head>
	<body class="no-js">
		<script type="text/javascript">
			document.body.className = document.body.className.replace( 'no-js', 'js' );
		</script>
		<!--[if lt IE 8]>
			<div class="row">
				<div class="col-12 text-center alert alert-danger">
					Користите <strong>застарели</strong> прегледач веба. Молимо вас да га <a href="http://browsehappy.com/?locale=sr_RS">ажурирате</a> да бисте унапредили доживљај.
				</div>
			</div>
		<![endif]-->
		<div class="container">
			<h1 class="display-4 text-center">Пресловар</h1>
			<form action="" method="get">
				<div class="row">
					<div class="col-md-6">
						<div class="mt-3">
							<button type="button" class="btn btn-primary disabled field-title">ћирилица</button>
							<button type="button" id="cyrillic-copy" class="btn btn-default cursor-pointer clipboard-button hide-if-no-js" data-clipboard-action="copy" data-clipboard-target="#cyrillic">умножи</button>
							<button type="button" id="cyrillic-cut" class="btn btn-default cursor-pointer clipboard-button hide-if-no-js" data-clipboard-action="cut" data-clipboard-target="#cyrillic">исеци</button>
							<button type="button" id="cyrillic-reset" class="btn btn-default cursor-pointer resetter-button hide-if-no-js">очисти</button>
						</div>
						<div class="mt-3">
							<textarea id="cyrillic" name="ћ" class="form-control mousetrap" rows="3" tabindex="1" <?php echo Fields::$cyrillic_attributes; ?>><?php echo Fields::$cyrillic_textarea; ?></textarea>
						</div>
					</div>
					<div class="col-md-6">
						<div class="mt-3">
							<button type="button" class="btn btn-primary disabled field-title">латиница</button>
							<button type="button" id="latin-copy" class="btn btn-default cursor-pointer clipboard-button hide-if-no-js" data-clipboard-action="copy" data-clipboard-target="#latin">умножи</button>
							<button type="button" id="latin-cut" class="btn btn-default cursor-pointer clipboard-button hide-if-no-js" data-clipboard-action="cut" data-clipboard-target="#latin">исеци</button>
							<button type="button" id="latin-reset" class="btn btn-default cursor-pointer resetter-button hide-if-no-js">очисти</button>
						</div>
						<div class="mt-3">
							<textarea id="latin" name="л" class="form-control mousetrap" rows="3" tabindex="2" <?php echo Fields::$latin_attributes; ?>><?php echo Fields::$latin_textarea; ?></textarea>
						</div>
					</div>
				</div>
				<button type="submit" class="btn btn-primary mt-3 hide-if-js">Преслови</button>
			</form>
			<hr>
			<footer>
				<div class="d-inline-block">
					Направио <a href="http://www.milandinic.com/">Милан Динић</a>
				</div>
					<div class="d-inline-block float-right hide-if-no-js">
						<button id="shortcuts-link" class="btn btn-link cursor-pointer" data-toggle="modal" data-target="#shortcuts-modal" hidden="hidden">Пречице</button>
						<?php if ( $privacy = Privacy::get_privacy() ) : ?>
						<button id="privacy-link" class="btn btn-link cursor-pointer" data-toggle="modal" data-target="#privacy-modal">Приватност</button>
						<?php endif; ?>
					</div>
			</footer>
		</div>
		<?php if ( $privacy ) : ?>
			<div class="modal fade" id="privacy-modal" tabindex="-1" role="dialog" aria-labelledby="privacy-modal-label" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="privacy-modal-label">Приватност</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Затвори">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<?php
							echo $privacy;
							?>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary" data-dismiss="modal">Затвори</button>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>
		<div class="modal fade" id="shortcuts-modal" tabindex="-1" role="dialog" aria-labelledby="shortcuts-modal-label" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="shortcuts-modal-label">Пречице</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Затвори">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<h5>Ћирилица</h5>
						<ul>
							<li><code>ctrl+alt+c</code> поље</li>
							<li><code>ctrl+alt+u</code> умножити</li>
							<li><code>ctrl+alt+i</code> исећи</li>
							<li><code>ctrl+alt+o</code> очистити</li>
						</ul>
						<h5>Латиница</h5>
						<ul>
							<li><code>ctrl+alt+shift+l</code> поље</li>
							<li><code>ctrl+alt+shift+u</code> умножити</li>
							<li><code>ctrl+alt+shift+i</code> исећи</li>
							<li><code>ctrl+alt+shift+o</code> очистити</li>
						</ul>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Затвори</button>
					</div>
				</div>
			</div>
		</div>
		<?php foreach ( Dependencies::$scripts as $script ) : ?>
			<script type="text/javascript" src="<?php echo $script; ?>"></script>
		<?php endforeach; ?>
		<?php Custom::display(); ?>
	</body>
</html>
