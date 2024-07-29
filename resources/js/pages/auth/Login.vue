<template>
    <section class="h-100 gradient-form" style="background-color: #eee">
        <div class="container py-5 h-100">
            <div
                class="row d-flex justify-content-center align-items-center h-100"
            >
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6" style="width: 50% !important">
                                <!-- style="min-height: 75vh" -->
                                <div
                                    class="card-body p-md-5 mx-md-4"
                                    style="padding: 40px !important"
                                >
                                    <div class="text-center">
                                        <img
                                            src="../../assets/images/logo.svg"
                                            style="width: 185px"
                                            alt="logo"
                                        />
                                        <h4 class="mt-1 mb-5 pb-1"></h4>
                                    </div>

                                    <form>
                                        <div class="form-outline mb-4">
                                            <label
                                                class="form-label"
                                                for="form2Example11"
                                                >Username</label
                                            >
                                            <input
                                                type="email"
                                                id="form2Example11"
                                                class="form-control"
                                                placeholder="Phone number or email address"
                                                v-model="user.email"
                                            />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label
                                                class="form-label"
                                                for="form2Example22"
                                                >Password</label
                                            >
                                            <input
                                                type="password"
                                                id="form2Example22"
                                                class="form-control"
                                                placeholder="Your password"
                                                v-model="user.password"
                                            />
                                        </div>

                                        <Errors></Errors>

                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <button
                                                class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3 mr-2 login-btn"
                                                type="button"
                                                @click="login()"
                                            >
                                                Log in
                                            </button>
                                            <a class="text-muted" href="#!"
                                                >Forgot password?</a
                                            >
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div
                                class="col-lg-6 d-flex align-items-center gradient-custom-2 justify-content-center text-center"
                                style="width: 50% !important"
                            >
                                <div
                                    class="text-white px-3 py-4 p-md-5 mx-md-4"
                                >
                                    <h4 class="mb-4" style="color: white">
                                        Noujoum centre
                                    </h4>
                                    <p class="small mb-0">
                                        Noujoum centre management system
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { useRouter } from "vue-router";
import { computed, ref } from "vue";
import { useAuthStore } from "../../store/auth";
import Errors from "../../Components/ui/Errors.vue";

// stores
const authStore = useAuthStore();
// consts

let router = useRouter();

const user = {
    email: "",
    password: "",
};
async function login() {
    await authStore
        .login(user.email, user.password)
        .then((res) => {
            router.push({ name: "Home" });
        })
        .catch((err) => {});
}
</script>

<style scoped>
.gradient-custom-2 {
    /* fallback for old browsers */
    background: #fccb90;

    /* Chrome 10-25, Safari 5.1-6 */
    background: -webkit-linear-gradient(
        to right,
        #ee7724,
        #d8363a,
        #dd3675,
        #b44593
    );

    /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    background: linear-gradient(to right, #242eee, #365ed8, #4436dd, #9345b4);
}

@media (min-width: 768px) {
    .gradient-form {
        height: 100vh !important;
    }
}
@media (min-width: 769px) {
    .gradient-custom-2 {
        border-top-right-radius: 0.3rem;
        border-bottom-right-radius: 0.3rem;
    }
}
.login-btn {
    border: none;
    margin-right: 15px;
}
</style>
