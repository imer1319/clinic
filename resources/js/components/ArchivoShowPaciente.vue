<template>
	<div class="modal fade" id="modalShowArchive" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalLabel">{{ data.title }}</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<img v-if="data.title" :src="`${data.image}`" alt="img" width="100%" />
				</div>
			</div>
		</div>
	</div>
</template>
<script>
export default{
	props:['data']
}
</script>