<template>
	<div class="library-list">
		<div class="page-header">
			<h2 class="heading-title">Group</h2>
		</div>

		<div class="table-responsive">
			<table-base :data="references">
				<template v-slot:columns>
					<th class="heading-small text-center">Title</th>
					<th class="heading-small text-center">Label</th>
					<th class="heading-small text-center">Expires At</th>
					<th class="heading-small text-center">Actions</th>
				</template>

				<template v-slot:default="row">
					<td class="text-center">
						<a :href="row.item.source" target="_blank">
							{{ row.item.title }}
						</a>
					</td>

					<td class="text-center">
						{{ $titlecase(row.item.category) }}
					</td>

					<td class="text-center">
						{{ row.item.expires_at }}
					</td>

					<td class="text-center">
						<dropdown-base icon="more_vert">
							<li class="dropdown-item d-flex align-items-center clickable">
								<span class="icon material-icons-outlined"> add </span>
								<span>Add to</span>
							</li>

							<li class="dropdown-item d-flex align-items-center clickable">
								<span class="icon material-icons-outlined"> edit </span>
								<span>Edit</span>
							</li>
							<li
								class="dropdown-item d-flex align-items-center clickable"
								@click="deleteReference(row.item.id)"
							>
								<span class="icon material-icons-outlined text-danger">
									delete
								</span>
								<span class="text-danger">Delete</span>
							</li>
						</dropdown-base>
					</td>
				</template>
			</table-base>
		</div>
	</div>
</template>
<script>
	import useReferences from '../composables/references';
	import { onMounted } from 'vue';

	export default {
		props: {
			id: {
				required: true,
				type: String
			}
		},
		setup() {
			const { references, getReferences, destroyReference } = useReferences();
			onMounted(getReferences);

			const deleteReference = async (id) => {
				if (!window.confirm('Are you sure?')) {
					return;
				}

				await destroyReference(id);
				await getReferences();
			};

			return { references, deleteReference };
		}
	};
</script>

