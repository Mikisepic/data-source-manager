<template>
  <div>
    <card shadow footerTextPosition="end">
      <template v-slot:header>
        <slot name="header">
          <div class="d-flex justify-content-between align-items-center w-100">
            <h5 class="heading-title my-0">My account</h5>
            <h6 class="heading-title my-0">{{ user.username }}</h6>
          </div>
        </slot>
      </template>

      <form @submit.prevent="saveUser">
        <h6 class="heading-small text-muted mb-4">User information</h6>

        <div class="row">
          <div class="col">
            <input-base
              label="Username"
              placeholder="Username"
              input-classes="form-control-alternative"
              v-model="user.username"
            />
          </div>
          <div class="col">
            <input-base
              label="Email address"
              placeholder="user@email.com"
              input-classes="form-control-alternative"
              v-model="user.email"
            />
          </div>
        </div>

        <div class="row mt-4">
          <div class="col">
            <input-base
              label="First name"
              placeholder="First name"
              input-classes="form-control-alternative"
              v-model="user.name"
            />
          </div>

          <div class="col">
            <input-base
              label="Last name"
              placeholder="Last name"
              input-classes="form-control-alternative"
              v-model="user.last_name"
            />
          </div>
        </div>

        <hr class="my-4" />

        <h6 class="heading-small text-muted mb-4">Residential information</h6>
        <div class="pl-lg-4">
          <input-base
            label="Location"
            placeholder="Location"
            input-classes="form-control-alternative"
            v-model="user.location"
          />

          <div class="row mt-4">
            <div class="col">
              <input-base
                label="Occupation"
                placeholder="Occupation"
                input-classes="form-control-alternative"
                v-model="user.occupation"
              />
            </div>
            <div class="col">
              <input-base
                label="Education"
                placeholder="Education"
                input-classes="form-control-alternative"
                v-model="user.education"
              />
            </div>
          </div>
        </div>

        <hr class="my-4" />

        <h6 class="heading-small text-muted mb-4">About me</h6>
        <div class="pl-lg-4">
          <div class="form-group">
            <input-base>
              <textarea
                rows="4"
                class="form-control form-control-alternative"
                placeholder="A few words about yourself ..."
                v-model="user.about_me"
              />
            </input-base>
          </div>
        </div>

        <hr class="my-4" />

        <button-base size="lg" nativeType="submit" type="primary" outline>
          Save
        </button-base>
      </form>
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
    const { user, errors, getUser, updateUser } = useUser();

    onMounted(getUser(props.id));

    const saveUser = async () => {
      await updateUser(props.id);
      await getUser(props.id);
    };

    return { user, errors, saveUser };
  }
};
</script>
