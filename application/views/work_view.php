<?php $this->load->view("header"); ?>
<?php
$header_array = ['Sale', 'Book', 'FOB ITC', '+/-', 'Code', 'Description', 'Note(On Quote)', 'Note(Internal)', 'Weight', 'Offer', 'Total', 'QUOTE: Price & Material Only', 'QUOTE 2: Price, Material & WEIGHT', 'QUOTE 3: Price, Material, Weight & AMOUNT', 'CRM NOTES'];
$class_array = ['sale', 'book', 'fob', 'plus', 'code', 'description', 'q-note', 'i-note', 'weight', 'offer', 'total', 'pm-quote', 'pmw-quote', 'pmwa-note', 'crm-note'];
?>
<style>
	th {
		font-size: 12px !important;
		padding: 0px !important;
		text-align: center !important;
	}

	td {
		padding: 0px !important;
	}

	td input {
		padding: 0 !important;
		margin: 0 !important;
		border-radius: 0px !important;
	}

	.btn-sm {
		font-size: 12px;
		padding: 0.3rem;
	}

	.form-control {
		height: 20px;
	}

	.logo a img {
		width: 200px;
	}
</style>
<div class="welcome-area four bg-white">
	<div class="anim-icons">
		<div class="icon icon-17"><img src="assets/temp/img/icon-img/shape.png" alt=""></div>
		<div class="icon icon-18"><img src="assets/temp/img/icon-img/shap-13.png" alt=""></div>
	</div>
	<div class="container h-100" style="max-width: 1920px;width: 100%;margin: 0;margin-top: 1rem">
		<div class="row">
			<div class="col-md-12">
				<button class="btn btn-danger float-right btn-sm" id="save">Save & Send</button>
			</div>
			<div class="col-md-12 mt-1">
				<div class="table-responsive-sm">
					<table class="table">
						<tbody>
							<tr>
								<td colspan="5"></td>
								<td colspan="2">
									<select class="form-control">
										<option value=""></option>
									</select>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-md-12 mt-3">
				<div class="table-responsive-sm">
					<table class="table">
						<thead>
							<?php foreach ($header_array as $header) { ?>
								<th><?= $header ?></th>
							<?php } ?>
						</thead>
						<tbody>
							<tr id="table_body">
								<?php foreach ($class_array as $class) { ?>
									<td><input type="text" class="form-control <?= $class ?>"></td>
								<?php } ?>
							</tr>
							<tr>
								<td style="border: 0px" colspan="11"></td>
								<td><textarea class="form-control pm-quote" style="height: 50px;padding: 0"></textarea></td>
								<td><textarea class="form-control pmw-quote" style="height: 50px;padding: 0"></textarea></td>
								<td><textarea class="form-control pmwa-quote" style="height: 50px;padding: 0"></textarea></td>
								<td><textarea class="form-control crm-quote" style="height: 50px;padding: 0"></textarea></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-md-12" style="text-align:center">
				<button class="btn btn-primary btn-sm" id="add_new">+ ADD NEW</button>
			</div>
		</div>
	</div>
</div>


<?php $this->load->view("footer"); ?>
<script type="text/javascript" src="assets/js/work.js"></script>
