<template>
<div class="container">

    <form @submit.prevent="update()">
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Name</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control is-expanded">
                        <input class="input is-small" v-model="user.name" type="text">
                    </p>
                </div>
            </div>
        </div>

        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Username</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control is-expanded">
                        <input class="input is-small" v-model="user.username" type="text">
                    </p>
                </div>
            </div>
        </div>

        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Email</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control is-expanded">
                        <input class="input is-small" v-model="user.email" type="email">
                    </p>
                </div>
            </div>
        </div>

        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Password</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control is-expanded">
                        <input class="input is-small" v-model="user.password" type="password">
                    </p>
                </div>
            </div>
        </div>

        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Avatar</label>
            </div>
            <div class="field-body">
                <b-field class="file">
                    <input type="file" v-on:change="onImageChange">
                    <span v-if="user.avatar">
                        {{ user.avatar.name }}
                    </span>
                </b-field>
            </div>
        </div>

        <div class="field is-horizontal">
            <div class="field-label">
                <!-- Left empty for spacing -->
            </div>
            <div class="field-body">
                <div class="field">
                    <div class="control">
                        <button class="button is-small is-primary">
                            Update
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>
</template>

<script>
import snackbar from './../../mixins/snackbar'

export default {
    props:['profile'],

    mixins:[snackbar],

    data() {
        return {
            user: {
                name: '',
                username: '',
                email: '',
                password: '',
                avatar: null
            }
        }
    },

    watch: {
        profile() {
            // this.user = this.profile;
            this.user.name = this.profile.name;
            this.user.username = this.profile.username;
            this.user.email = this.profile.email;
        }
    },

    methods: {
        onImageChange(e) {
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.createImage(files[0]);
        },
        createImage(file) {
            let reader = new FileReader();
            let vm = this;
            reader.onload = (e) => {
                vm.user.avatar = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        update() {
            axios.post('/profile', this.user)
                 .then((response) => {
                    this.snackbar('Your profile has been updated.')
                 })
                 .catch((error) => {
                    this.snackbar('Error encountered while updating your profile.')
                 })
        }
    }

}
</script>
