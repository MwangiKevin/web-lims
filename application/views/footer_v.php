<div class="footer">
	<div class="ui right aligned grid">
		<div class="right floated left aligned two wide column">
			&copy NASCOP <?php echo Date("Y")?>
			{{$storage.filter_type}}
		</div>
	</div>
</div>

<style>
.footer {
	bottom: 0;
	width: 100%;
	height: 40px;
	background-color: #000000;
	position: fixed;
	color:#fff;
}
</style>

<script>
    $('.ui.dropdown').dropdown();
    $( document ).tooltip();
    $('.ui.accordion').accordion();
</script>
