<template>
  <div>
    <card type="default" v-if="!!user" shadow show-footer-line>
      <div class="row">
        <div class="col">
          <div class="card-profile-stats d-flex justify-content-center">
            <div>
              <span class="heading">{{ user.total_references }}</span>
              <span class="description">References</span>
            </div>
            <div>
              <span class="heading">{{ user.total_collections }}</span>
              <span class="description">Collections</span>
            </div>
            <div>
              <span class="heading">{{ user.total_groups }}</span>
              <span class="description">Groups</span>
            </div>
          </div>
        </div>
      </div>
      <div class="text-center">
        <h4 class="heading-title">{{ user.name }} {{ user.last_name }}</h4>

        <h6 class="heading-title">{{ user.location }}</h6>
        <h6 class="heading-title mt-4">{{ user.occupation }}</h6>
        <span>{{ user.education }}</span>
      </div>

      <div>
        <hr class="my-4" />
        <p>{{ user.about_me }}</p>
      </div>
    </card>
  </div>
</template>
<script>
import { onMounted } from 'vue';
import useUser from '../composables/user';

export default {
  props: {
    id: {
      required: true,
      type: String
    }
  },

  setup(props) {
    const { user, errors, getUser } = useUser();

    onMounted(getUser(props.id));

    return { user, errors };
  }
};
</script>
