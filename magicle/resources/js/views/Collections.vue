<template>
	<div>
		<div class="page-header">
			<h2 class="heading-title">Collections</h2>
		</div>

		<div class="collections">
			<card
				shadow
				clickable
				v-for="collection in collections"
				v-bind:key="collection.id"
			>
				<template v-slot:header>
					<h3>{{ collection.title }}</h3>

					<div class="d-flex align-items-center">
						<span
							class="icon material-icons-outlined delete"
							@click="deleteCollection(collection.id)"
						>
							delete
						</span>
						<router-link
							class="preview"
							:to="{ name: 'previewCollection', params: { id: collection.id } }"
						>
							<span class="icon material-icons-outlined">visibility</span>
						</router-link>
					</div>
				</template>

				<div class="d-flex justify-content-between align-items-center py-2">
					<h5 class="heading-title text-muted">Total References:</h5>
					<h2 class="heading-title">{{ collection.totalReferences }}</h2>
				</div>

				<template v-slot:footer>
					<slot name="footer">
						<span class="heading-small">Last Updated</span>
						<span class="last-update text-muted">
							{{ new Date(collection.updated_at).toDateString() }}
						</span>
					</slot>
				</template>
			</card>

			<div
				class="add-collection clickable material-icons"
				data-bs-toggle="modal"
				data-bs-target="#addCollection"
			>
				add_circle
			</div>
		</div>

		<div class="modal fade" id="addCollection" tabindex="-1" aria-hidden="true">
			<div class="collections-modal modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="heading-title">Create New Collection</h5>
						<button-base size="lg" type="close" data-bs-dismiss="modal" />
					</div>

					<form role="form" @submit.prevent="saveCollection">
						<div class="modal-body">
							<ul class="p-0 mb-2" v-for="(v, k) in errors" :key="k">
								<li class="text-danger" v-for="error in v" :key="error">
									{{ error }}
								</li>
							</ul>

							<input-base
								label="Title"
								input-classes="form-control mb-3"
								v-model="form.title"
							/>

							<div class="mb-3 form-check">
								<input
									type="checkbox"
									class="form-check-input"
									id="isPublicCheck"
									v-model="form.isPublic"
								/>
								<label class="form-check-label" for="isPublicCheck">
									Is Public Collection
								</label>
							</div>
						</div>

						<div class="modal-footer">
							<button-base
								size="lg"
								type="secondary"
								data-bs-dismiss="modal"
								outline
							>
								Close
							</button-base>
							<button-base size="lg" nativeType="submit" type="primary" outline>
								Add Collection
							</button-base>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	import { onMounted, reactive } from 'vue';
	import useCollections from '../composables/collections';

	export default {
		setup() {
			const form = reactive({
				title: '',
				isPublic: true
			});

			const {
				collections,
				getCollections,
				errors,
				storeCollection,
				destroyCollection
			} = useCollections();

			const saveCollection = async () => {
				await storeCollection({ ...form });
				await getCollections();
			};

			const deleteCollection = async (id) => {
				if (!window.confirm('Are you sure?')) {
					return;
				}

				await destroyCollection(id);
				await getCollections();
			};

			onMounted(getCollections);

			return { collections, form, errors, saveCollection, deleteCollection };
		}
	};
</script>
