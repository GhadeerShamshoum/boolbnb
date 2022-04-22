<template>
    <div>
        <!-- jumbotron -->
        <div class="container-fluid">
            <div class="row ms_jumbotron">
                <div class="ms_imagecontainerJumbo col-10 p-0">
                    <img  src="../../../public/storage/uploads/jubotron.jpg" alt="">
                    <div class="ms_textcontainer">
                        <h1 class="text-white ms_textJombo">Lasciati guidare dalla curiosità</h1>
                        <button>Sono flessibile</button>
                    </div>
                </div>
            </div>            
        </div>

        <!-- appartamenti consigliati -->
        <div class="container-fluid ms_apartmentSlider col-12">
            <h1>Appartamenti Dei Nostri Migliori Host</h1>
            <vue-horizontal>
                <section v-for="apartment in apartments" :key="apartment.id">
                    <div v-if="apartment.visible && apartment.sponsorships.length != 0" class="d-flex flex-column">
                        <router-link :to="{name: 'SingleApartment', params: {slug: apartment.slug}}" class="">
                            <div v-for="image in apartment.images" :key="image.id"><!-- non usare ccs su questo div -->
                                <p v-if="image.main_image"  class="ms_cardImage">
                                    <img  :src="`/storage/${image.url}`"  class="border">
                                </p>
                            </div>
                        </router-link>
                        <div class=" ms_description">
                            <router-link :to="{name: 'SingleApartment', params: {slug: apartment.slug}}">
                                <h5>{{apartment.name}}</h5>
                            </router-link>
                        </div>
                    </div>
                </section>

                <template v-slot:btn-prev>
                    <button><i class="fa-solid fa-arrow-left"></i></button>
                </template>

                <template v-slot:btn-next>
                    <button><i class="fa-solid fa-arrow-right"></i></button>
                </template>
            </vue-horizontal>
        </div>
        
        <!-- cities cards -->
        <div class="container-fluid">
            <div class="row">
                <div class="ms_citiesContainer container-fluid d-flex flex-column">
                    <h1 class="mb-2">Destinazioni Più Gettonate</h1>
                    <div class="row ms_flexContainer d-flex col-12">
                        <div v-for="(element, index) in cities" :key="index" class="ms_cityCard col"  :style="{'background-color':colors[index]}">
                            <div class="ms_imageContainer">
                                <img :src="require('../../../public/storage/uploads/'+element.image+'.jpg') " alt="">
                            </div>
                            <div class="ms_textcity">
                                <h1 class="text-white">{{element.title}}</h1>
                                <h4 class="text-white">{{element.text}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Esperienze Boolbnb -->
        <div class="container-fluid">
            <div class="row ms_experienceContainer col-12">
                <h1>Scopri le Esperienze Boolbnb</h1>
                <div class="ms_imgsEsp row">
                    <div class="ms_imgEsp col">
                        <img  src="../../../public/storage/uploads/experience2.jpg" alt="">
                        <h1 class="ms_esptext text-white">Esperienze <br> per il tuo viaggio</h1>
                    </div>
                    <div class="ms_imgEsp col">
                        <img  src="../../../public/storage/uploads/experience1.jpg" alt="">
                        <h1 class="ms_esptext text-white">Attività <br> da casa</h1>
                    </div>  
                </div>
            </div>
        </div>

        <!-- gift card  -->
        <div class="container-fluid">
            <div class="row ms_giftContainer col-12">
                <div class="col-4">
                    <h1 class="ms_giftFont">Acquista <br> le gift card <br> di Airbnb</h1>
                </div>
                <div class="ms_giftImg col-8">
                    <img  src="../../../public/storage/uploads/gift.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import VueHorizontal from 'vue-horizontal';
export default {
    name: "Homepage",
    components: {VueHorizontal},
    data(){
      return{
          apartments:[],
          colors:['#DE3151', '#BC1A6E', '#CC2D4A', '#D93B30'],
          cities:[
              {
                image:"city1",
                title:"Napoli",   
                text:"189 chilometri di distanza",
              },
              {
                image:"city2",
                title:"Bologna",
                text:"303 chilometri di distanza",
              }, 
              {
                image:"city3",
                title:"Roccaraso",
                text:"132 chilometri di distanza",
              }, 
              {
                image:"city4",
                title:"Verona",
                text:"411 chilometri di distanza",
              },     
          ]
      }
    },
    created() {
        axios
        .get("/api/apartments")
        .then((response) => {
            this.apartments = response.data;
        });
    },

}
</script>

<style lang="scss" scoped>

.ms_jumbotron{
    background-color: black;
    height: 800px;
    display: flex;
    justify-content: center;
    position: relative;
    
    .ms_imagecontainerJumbo{
        margin-top: 200px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        height: 712px;
        width: 1319px;
        border-radius: 20px;
        overflow: hidden;
        img{
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .ms_textcontainer{
            position: absolute;
                bottom: 30px;
                left: 50%;
                transform:translate(-50%, -50%);
                width: 700px;
                display: flex;
                flex-direction: column;
                align-items: center;
            .ms_textJombo{
                font-size: 50px;
                text-align: center;
            }
            button{
                margin:15px auto;
                padding:12px 22px;
                border: none;  
                border-radius: 20px;  
                font-size: 15px;      
                color: rgb(64, 14, 64);  
                }
        }
    }
    
}

// appartamenti
.ms_apartmentSlider{
    width: 1319px ;
    margin: 200px auto 40px auto;

    button{
        color:white;
        background: #DE3151;
        padding: 10px 15px;
        font-weight:900;
        border: 0px;
        border-radius:50%;
    }

    section{
        max-width: 320px;
        margin: 20px 10px;
        text-align: center;
    }

    h5{
        max-width: 320px;
        margin: 0 10px;
    }

    a{
        color:black;
        text-decoration:none;
    }

    .ms_cardImage{
        margin-bottom:0;
        padding: 20px 10px;

        img{
            height: 200px;
            width: 300px;
            border-radius: 13px
        }

    }

}

.ms_citiesContainer { 
    width: 1319px ;
    margin:40px auto 90px auto;
    .ms_flexContainer{
        display: flex;
        justify-content: space-between;
    }
    .ms_cityCard{
        width: calc(100% / 4 - 20px);
        border-radius: 20px;
        padding: 0;
        margin: 0 15px;
        height: 400px;
        overflow: hidden;
        .ms_imageContainer{
            height: 200px;
            width: 100%;
            overflow: hidden;
            img{
                width: 100%;
                object-fit: cover;
            }
        }
        .ms_textcity{
            padding: 20px;
        }
    
    }
}
.ms_experienceContainer{
    width: 1319px ;
    margin:40px auto;
    .ms_imgsEsp{
        width: 100%;
        display: flex;
        justify-content: space-between;
        .ms_imgEsp{
            
            overflow: hidden;
            position: relative;
            img{
                width: 100%;
                border-radius: 20px;
            }
            .ms_esptext{
                position: absolute;
                top: 80px;
                left: 60px;
                font-size: 60px;
            }
        }
    }
}

.ms_giftContainer{
    width: 1319px ;
    margin:100px auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    .ms_giftFont{
        font-size: 65px;
    }
    .ms_giftImg{
        img{
            width: 100%;
        }
    }
}
</style>
