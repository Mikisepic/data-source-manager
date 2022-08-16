<template>
  <div>
    <div class="groups">
      <card shadow clickable v-for="group in groups" v-bind:key="group.id">
        <template v-slot:header>
          <h3>{{ group.title }}</h3>

          <div class="d-flex align-items-center">
            <span
              class="icon material-icons-outlined delete"
              @click="deleteGroup(group.id)"
            >
              delete
            </span>
            <router-link
              class="preview"
              :to="{ name: 'previewGroup', params: { id: group.id } }"
            >
              <span class="icon material-icons-outlined">visibility</span>
            </router-link>
          </div>
        </template>

        <div class="avatar-group">
          <div
            v-for="(user, index) in group.total_users > 5
              ? 5
              : group.total_users"
            v-bind:key="index"
            class="avatar clickable"
          >
            <span
              v-if="(index + 1) % 5 !== 0"
              class="icon material-icons-outlined"
              >account_circle</span
            >
            <span v-if="(index + 1) % 5 === 0">
              +{{ group.total_users - 5 }}
            </span>
          </div>
        </div>

        <template v-slot:footer>
          <slot name="footer">
            <h6 class="heading-small">Last active</h6>
            <span class="last-update text-muted">
              {{ new Date(group.updated_at).toDateString() }}
            </span>
          </slot>
        </template>
      </card>

      <div
        class="add-collection clickable material-icons"
        data-bs-toggle="modal"
        data-bs-target="#addGroup"
      >
        add_circle
      </div>
    </div>

    <div
      class="modal groups-modal fade"
      id="addGroup"
      tabindex="-1"
      aria-hidden="true"
    >
      <div class="collections-modal modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="heading-title">Create New Group</h5>
            <button-base size="lg" type="close" data-bs-dismiss="modal" />
          </div>

          <form role="form" @submit.prevent="saveGroup">
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
                Add Group
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
import useGroups from '../composables/groups';

export default {
  setup() {
    const form = reactive({
      title: ''
    });

    const { groups, getGroups, errors, storeGroup, destroyGroup } = useGroups();

    const saveGroup = async () => {
      await storeGroup({ ...form });
      await getGroups();
    };

    const deleteGroup = async (id) => {
      if (!window.confirm('Are you sure?')) {
        return;
      }

      await destroyGroup(id);
      await getGroups();
    };

    onMounted(getGroups);

    return { groups, form, errors, saveGroup, deleteGroup };
  }
};
</script>
