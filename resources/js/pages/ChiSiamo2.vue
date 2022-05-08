<template>
    <div>
        <div v-if="!loading" class="container container-lista">
            <div class="container">
              <div class="us row row-cols-3 justify-content-start container-body">
                  <div class="col ">
                    <a href="https://www.linkedin.com/in/antony-morgante-b754b8236/">
                        <button>
                            <div class="inside-button row">
                                <i class="fa-brands fa-linkedin linkedin"></i>
                                <p>Antony <br> Morgante</p>
                                <i class="fa-solid fa-user-ninja icona"></i>
                                <!-- chiedere a antony quale vuole -->
                            </div>
                        </button>
                    </a>
                  </div>
                  <div class="col">
                    <a href="https://www.linkedin.com/in/fabio-losa-825372236/">
                        <button>
                            <div class="inside-button row">
                                <i class="fa-brands fa-linkedin linkedin"></i>
                                <p>Fabio <br> Losa</p>
                                <i class="fa-solid fa-user-secret icona"></i>
                            </div>
                        </button>
                    </a>
                  </div>
                  <div class="col">
                    <a href="https://www.linkedin.com/in/ghadeershamshoum/">
                        <button>
                            <div class="inside-button row">
                                <i class="fa-brands fa-linkedin linkedin"></i>
                                <p>Ghadeer <br> Shamshoum</p>
                                <i class="fa-solid fa-user-nurse icona"></i>
                            </div>
                        </button>
                    </a>
                  </div>
                  <div class="col">
                    <a href="#/">
                        <button>
                            <div class="inside-button row">
                                <i class="fa-brands fa-linkedin linkedin"></i>
                                <p>Gianluca <br> Benedetti</p>
                                <i class="fa-solid fa-user-doctor icona"></i>
                            </div>
                        </button>
                    </a>
                  </div>
                  <div class="col">
                    <a href="https://www.linkedin.com/in/stefano-martignoni-922207238/">
                        <button>
                            <div class="inside-button row">
                                <i class="fa-brands fa-linkedin linkedin"></i>
                                <p>Stefano <br> Martignoni</p>
                                <i class="fa-solid fa-user-astronaut icona"></i>
                            </div>
                        </button>
                    </a>
                    </div>
        
                </div>
            </div>
        </div>
        <Loader v-else/>
    </div>
</template>

<script>
import Loader from "./Loader.vue";
export default {
    name: "ChiSiamo2",
    data() {
        return{
            loading: true
        }
    },
    components: {
        Loader
    },
    created() {
        axios
        .get("/api/apartments")
        .then(() => {
            this.loading = false;
        });
    }
}
</script>

<style scoped lang="scss">
    .us{
        margin: 300px 0;
    }

    button{
        padding: 5px 10px;
        margin: 10px;
        border-radius: 10px;
        border:0;
        width: 260px;
            p{
                margin-left: 5px;
                float: left;
                width: 82px;
            }

            .linkedin{
                color: #ff385c;
                width: 50px;
                height: 50px;
                vertical-align:text-bottom;
                float: left;
                padding-right: 20px;
            }
    }

    .icona{
        color: #ff385c;
        width: 50px;
        height: 50px;
        vertical-align: middle;
        float: left;
        padding-left: 20px;
    }

    .inside-button{
        padding: 10px 15px 0 15px;
    }

    .container-body{
        min-height: calc(100vh - 1110px);
    }
</style>