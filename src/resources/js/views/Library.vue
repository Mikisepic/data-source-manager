<template>
  <div class="library-list">
    <div class="page-header">
      <h2 class="heading-title">Library</h2>
    </div>

    <div class="table-responsive">
      <table-base :data="dataSources">
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
            <span>
              {{ $titlecase(row.item.category) }}
            </span>
          </td>

          <td class="text-center">
            <span>
              {{ row.item.expires_at }}
            </span>
          </td>

          <td class="text-center">
            <dropdown-base icon="more_vert">
              <li class="dropdown-item d-flex align-items-center clickable">
                <span class="icon material-icons-outlined">add</span>
                <span>Add to</span>
              </li>

              <li class="dropdown-item d-flex align-items-center clickable">
                <span class="icon material-icons-outlined">edit</span>
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

      <div
        class="add-collection clickable material-icons text-center w-100"
        data-bs-toggle="modal"
        data-bs-target="#addCollection"
      >
        add_circle
      </div>

      <div
        class="modal fade"
        id="addCollection"
        tabindex="-1"
        aria-hidden="true"
      >
        <div class="collections-modal modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="heading-title">Create New Data Source</h5>
              <button-base size="lg" type="close" data-bs-dismiss="modal" />
            </div>

            <form role="form" @submit.prevent="saveReference">
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

                <input-base
                  label="Source"
                  input-classes="form-control mb-3"
                  v-model="form.source"
                />

                <div class="form-group has-label">
                  <label class="form-control-label">Category</label>
                  <br />
                  <select
                    name=""
                    id=""
                    v-model="form.category"
                    class="form-control form-control mb-3"
                  >
                    <option value="event">event</option>
                    <option value="registration">registration</option>
                    <option value="link">link</option>
                    <option value="article">article</option>
                  </select>
                </div>

                <div class="form-group has-label">
                  <label class="form-control-label">Collection</label>
                  <br />
                  <select
                    name=""
                    id=""
                    v-model="form.collection_id"
                    class="form-control form-control mb-3"
                  >
                    <option
                      v-for="collection in collections"
                      v-bind:key="collection.id"
                      :value="collection.id"
                    >
                      {{ collection.title }}
                    </option>
                  </select>
                </div>

                <input-base
                  label="Expires At"
                  type="date"
                  input-classes="form-control mb-3"
                  v-model="form.expires_at"
                />
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
                <button-base
                  size="lg"
                  nativeType="submit"
                  type="primary"
                  outline
                >
                  Add Reference
                </button-base>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import useDataSources from '../composables/dataSources';
import useCollections from '../composables/collections';
import { onMounted, reactive } from 'vue';

export default {
  setup() {
    const {
      errors,
      dataSources,
      getDataSources,
      storeDataSource,
      destroyDataSource
    } = useDataSources();

    const { collections, getCollections } = useCollections();

    const form = reactive({
      title: '',
      source: '',
      category: '',
      collection_id: '',
      expires_at: ''
    });

    onMounted(getDataSources);
    onMounted(getCollections);

    const saveDataSource = async () => {
      await storeDataSource({ ...form });
    };

    const deleteDataSource = async (id) => {
      if (!window.confirm('Are you sure?')) {
        return;
      }

      await destroyDataSource(id);
      await getDataSources();
    };

    return {
      form,
      errors,
      dataSources,
      collections,
      saveDataSource,
      deleteDataSource
    };
  }
};
</script>
