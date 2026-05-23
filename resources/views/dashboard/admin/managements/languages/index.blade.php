<x-dashboard.admin.layout.app>

	<x-slot name="title">{{ trans('admin.models.managements') . ' - ' . trans('admin.models.languages') }}</x-slot>	
	
	<h1 class="text-lg font-semibold mb-2">{{ trans('admin.models.languages') }}</h1>

	<x-dashboard.admin.layout.includes.breadcrumb :breadcrumb='$breadcrumb' />

	<div class="flex flex-wrap items-center lg:items-end justify-between pt-3.5">
		
		<div class="flex items-center gap-3">
			
			<x-dashboard.admin.button.add permission="create-languages"/>

			<x-dashboard.admin.button.bulk-delete permission="delete-languages"/>

		</div>

	</div>

	<div class="grid gap-5 lg:gap-7.5">
	
		<div class="kt-card-grid min-w-full my-5">
	
			<div class="flex-wrap gap-2 mb-2.5">

				<div class="flex flex-wrap gap-2 lg:gap-5">
				
					<div class="flex">
				
						<x-dashboard.admin.data-table.search />
				
					</div>
				
					<x-dashboard.admin.data-table.filter />
				
				</div>

			</div>{{-- flex-wrap --}}
	
			<div class="kt-card-content">
				
				<div class="grid">
					
					<div class="kt-scrollable-x-auto">

						<table class="datatable"id="data-table">
					
							<x-dashboard.admin.data-table.header :columns='$datatables["header"]' />
					
						</table>
					
					</div>

				</div>{{-- grid --}}

			</div>{{-- card-content --}}

		</div>{{-- card --}}

	</div>{{-- grid --}}

	<x-slot name="scripts">

        <x-dashboard.admin.data-table.script :datatables='$datatables'/>

        <script>
    		$(document).on('change', '.default', function (e) {
	            e.preventDefault();

	            let url    = "{{ route('dashboard.admin.managements.languages.default') }}";
	            let method = 'post';
	            let id     = $(this).data('id');

	            $.ajax({
	                url: url,
	                data: {id: id},
	                method: method,
	                success: function (response) {

	                    $('.datatable').DataTable().ajax.reload();

	                    new Noty({
	                        layout: 'topRight',
	                        type: 'alert',
	                        text: response,
	                        killer: true,
	                        timeout: 2000,
	                    }).show();
	                },

	            });//end of ajax call

	        });//end of delete
    	</script>

    </x-slot>

</x-dashboard.admin.layout.app>