<template>
    <header class="container-fluid" :class="{ 'is-hidden': !scrollEffect }" @click="deselect">
        <div class="row">
          <div class="header-container col-12">

            <!-- header left -->
            <div class="col-3 d-none d-xl-block headerleft" :class="{ 'pink': scrollEffect }">
                <i class="fa-brands fa-airbnb"></i>
                <a href="/">
                  <span>Boolbnb</span>
                </a>
            </div>

            <!-- header center -->
            <div class="col-12 col-xl-5 headercenter d-flex flex-column align-items-center m-auto">
                <nav :class="{ 'hide': scrollEffect }">
                <ul class="row">
                    <li class="fontLink"><router-link :to="{ name: 'Homepage' }">Homepage</router-link></li>
                    <li class="fontLink"><router-link :to="{ name: 'ApartmentList' }">Appartamenti</router-link></li>
                    <li class="fontLink"><router-link :to="{ name: 'ChiSiamo2' }">Chi Siamo</router-link></li>
                </ul>
                </nav>
                <div class="d-flex headercenterB justify-content-center  align-items-center m-auto container-fluid">
                  <div class="row col-12">
                      <div class="inputContainer col-12 col-lg-10 d-flex justify-content-between" @keyup.enter.stop="filter" :class="{ 'search': scrollEffect }">
                        <input class="col-8 ml-4" placeholder="Dove vuoi andare?" type="text" v-model="search" @input="autocomplete" value="choosedSearch">
                        <div class="col-2 p-0 ms_icon" :class="searchIsSet ? '' : 'notSearchIcon'" @click="filter"><i  class="fa-solid fa-magnifying-glass searchIcon" ></i></div>
                        <div class="autocompleters col-12" v-show="autocompleters">
                          <div class="option" v-for="(option, index) in autocompleters" :key="index" @click.stop="setSearch(index)">
                              <a href="#">{{option.address.freeformAddress}}</a>
                          </div>
                        </div> 
                      </div>
                      <div class="col-2">
                        <a class="ms_search" href="#" @click.stop='ricercaAvanzata'>
                          <button class="ms_btnSearch d-none d-lg-block">Ricerca  <br>Avanzata</button>
                        </a>
                      </div>
                  </div>
                </div>
            
            <!-- campi aggiuntivi -->
            <div class="container-fluid" v-show="selectOption" @click.stop="" >
              <div class="row col filter d-flex flex-column mt-3">
                <div>
                  <label for="rooms">Numero di Stanze</label>
                    <input type="number" min="1" max="10" id="rooms" name="rooms" v-model="rooms">
                  <label for="beds">Numero di Letti</label>
                    <input type="number" min="1" max="6" id="beds" name="beds" v-model="beds">
                  <label for="range">Raggio di Ricerca</label>
                    <input type="number" min="5" max="50" id="radius" name="radius" step="5" v-model="radius">
                </div>

                <div>
                  <!--services  -->
                  <div class="text-black  mt-4 mb-2" :class="{ 'services': !scrollEffect }"><strong>Servizi:</strong></div>
                  <div class="services" v-for="(service,index) in services" :key="index">
                    <input type="checkbox" id="service" name="services[]" @change="serviceList(index)">
                  <label :class="{ 'services': !scrollEffect }" class="text-black" for="service">{{service.name}}</label><br>    
                  </div>
                </div>
              </div>              
            </div>

              </div>
            
            <!-- header right -->
            <div class="headerright d-none d-lg-block col-3">
                <ul>
                <li>Diventa un Host</li>
                <li><i class="fa-solid fa-globe"></i></li>
                <li>
                  <button @click.stop="setHeaderDropdownValue()"><i class="fa-solid fa-bars m-2"></i><i class="fa-solid fa-user m-2"></i></button>
                </li>
                </ul>
                <nav class="header-dropdown" v-show="headerDropdown">
                  <li><a href="/register">Registrati</a></li>
                  <li><a href="/admin">Accedi</a></li>
                  <li><a href="#">Diventa un host</a></li>
                  <li><a href="#">Proponi un'esperienza</a></li>
                  <li><a href="#">Assistenza</a></li>
                </nav>
            </div>
          </div>
        </div>
    </header>
</template>

<script>
export default {
  name: 'Header',
   data (){
     return{
        menuStatus: false,
        scrollEffect: false,
        lastScrollPosition: 0,
        scrollOffset: 0,
        selectOption: false,
        links:[
          {
            text: "Places to visit",
            current: true,
          },
          {
            text: "Experiences",  
            current: false,
          },
          {
            text: "Online experiences",     
            current: false,
          },
        ],
        search : "",
        searchLat:"",
        searchLon:"",
        autocompleters:[],
        services:[],
        beds: 1,
        rooms: 1,
        servicesList: "",
        radius: 20,
        searchIsSet:false,
        headerDropdown:false
    }
  },
  created(){
    axios
      .get("/api/services")
      .then((response) => {
        this.services = response.data;
      });  
  },

  mounted() {
    this.lastScrollPosition = window.pageYOffset
    window.addEventListener('scroll', this.onScroll)
  },
  computed: {
    choosedSearch(){    
      return this.search;
    }
  },
  methods: {
    setHeaderDropdownValue(){
      if(!this.headerDropdown){
        this.headerDropdown = true;
      } else {
        this.headerDropdown = false;
      }
    },
    //autocomplete
    autocomplete(){
      if(this.search == ""){
        this.autocompleters = [];
      } else {
        axios
          .get("https://cors-anywhere.herokuapp.com/https://api.tomtom.com/search/2/search/"+this.search+".json?key=5EIy0DQg5tZyBLLvAxNfCI6ei8DPGcte&typeahead=true&limit=5&countrySet=IT&language=it-IT")
          .then((response) => {
            this.autocompleters = response.data.results;
          });     
      }  
    },
    setSearch(index){
      this.search = this.autocompleters[index].address.freeformAddress;
      this.searchLat = this.autocompleters[index].position.lat;
      this.searchLon = this.autocompleters[index].position.lon;
      this.searchIsSet = true;
      document.getElementsByClassName(".searchIcon").classList
      this.autocompleters = [];
    },
    serviceList(counter){
      if(document.querySelectorAll("#service")[counter].checked){
          this.servicesList += (counter+1) + "-";
        }
         else{
        this.servicesList=this.servicesList.replace((counter+1)+"-","");
      }
    },
    filter(){
      if(this.searchIsSet){
        this.autocompleters = [];
        this.selectOption = false;
        if(this.servicesList == ""){
          this.servicesList = "0-";
        }
        this.$emit('filter',{"search": this.search,"lat":this.searchLat,"lon":this.searchLon, "beds":this.beds, "rooms":this.rooms, "radius":this.radius, "servicesList":this.servicesList});             
      } 
    },
 
     deselect(){
      this.autocompleters = [];
      this.search = "";
      this.selectOption= false,
      this.headerDropdown = false;

    },
    // Toggle if navigation is shown or hidden
    onScroll() {
      if (window.pageYOffset < 0) {
        return
      }
      this.scrollEffect =  this.lastScrollPosition < window.pageYOffset
    },
    ricercaAvanzata: function(){
      if(this.selectOption===false){
          this.selectOption=true;
      }else 
      if(this.selectOption===true){
          this.selectOption=false;
      }
    },
  },
  props: {
    
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="scss">

a{
  text-decoration: none;
  color: #ff385c;
}

header{
  position: fixed;
  top: 0;
  width: 100%;
  min-height: 125px;
  background-color: white;
  color: black;
  transition: .5s ease all; 
  z-index: 1000;
  .header-container{
    position:relative;
    display: flex;
    justify-content: space-between;
    padding-top: 20px;
    .headerleft{
      font-size: 26px;
      font-weight: 500;
      padding-left: 7%;
      transition: 1s ease all; 
      &:hover{
        font-size: 29px;
      }
    }
    .headercenter{
      min-width: 375px;
      nav{
        ul{
          display: flex;
          list-style: none;
          li{
            margin: 10px;
            border-bottom: 1px black;
            width: 92px;
            transition: 1s ease all; 
            &:hover{
              font-size: 15px;
              font-weight: 700;
            }
            a{
              cursor: pointer;
              color:white;  
            }
            
          }
        }
      }
      .headercenterB{
        min-width: 375px;
        width: 100%;
        z-index: 999;
        .ms_search{
          text-decoration: none;
          .ms_btnSearch{
          min-height: 60px;
          background-color: #ff385c;
          border: none;
          border-radius: 25px;
          margin:0 10px;
          padding: 5px 20px;
          text-align: center;
          transition:linear .5s;
          color:white;
          &:hover{
            background-color: #df4e69;
            color: white;
          }
        }
        }

          .inputContainer{
            position: relative;
            z-index: 999;
            .ms_icon{
              display: flex;
              justify-content: end;
              width: 30px;
              align-items: center;
              .searchIcon{
                  background-color: #ff385c;
                  transition:linear .5s;
                  border-radius: 50%;
                  color: white;
                  padding: 15px;
                  &:hover{
                    padding: 17px;
                    background-color: hwb(349 17% 45%);
                  }
              }
                .searchIcon:hover{
                  cursor: pointer;
                }        
            }
          }
      }
    }
    .headerright{
      ul{
        list-style: none;
        display: flex;
        align-items: center;
       
        li{
          padding: 10px;
          button{
            border: none;
            border-radius: 35px;
            padding: 2px;
            width: 90px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: .5s ease all; 
            &:hover{
              width: 95px;
            }
            .fa-user{
              border-radius: 50%;
              background-color: #717171;
              padding: 5px;
              color: white;
            }
          }
        }
      }
    }
  }
  .inputContainer{
    background-color: white;
    border-radius: 30px;
    height: 60px;
    padding: 3px;
    display: flex;
    align-items: center;
    input{
      border: none;
    }
  }
}
.is-hidden {
    background: black;
     color: white;
    transition: .5s ease all; 
    min-height: 153px;
}
.pink{
  color:#ff385c;
}
.hide{
  display: none;
}
.search{
  width: 300px;
  border: none;
}

.autocompleters{
  background-color: white;
  border: 1px solid gray;
  color:black;
  width:100%;
  position:absolute;
  top: -5px;
  left:50%;
  transform: translateX(-50%);
  border-radius: 30px;
  padding: 60px 0px 10px 0;
  z-index: -1;
  transition: .5s ease all;
  .option{
    width: 100%;
    color: grey;
    padding: 8px 0;
    transition: .5s ease all;
    cursor: pointer;
      &:hover{
      background-color: rgb(237, 231, 231);
      }
      a{
        padding-left: 39px;
        text-decoration: none;
        color:rgb(193, 187, 187);
        transition: .5s ease all;
        width: 100%;    
      }
      &:hover a{
        color:black;
    }
  }
}

input:focus, textarea:focus, select:focus{
  outline: none;
}
.filter{
  padding: 10px 0;
  max-width: 374px;
}
@media only screen and (min-width:1200px){
    .filter{
    max-width: 760px;
    min-width: 480px;
  }
}



label{
  font-size: 10px;
}
select{
    height: 20px;
    width: 33px;
  }
  select.ms_km{
    width: 70px;
}
@media only screen and (min-width:1200px){
    label{
    font-size: 15px;
    select{
      height: 25px;
      .ms_km{
        width: 40px;
      }  
    }
  }
}

.servicesContainer{

  .services{
    color: white;
    width: 100%;
  }
}

input[type=number]{
  width: 50px;
  margin-right: 5px;

}
.notSearchIcon{
    opacity: 0.3;
}

.fontLink{
  text-align: center;
}

.header-dropdown{
  list-style-type: none;
  background-color: white;
  color: black;
  width: 40%;
  padding: 12px;
  position: absolute;
  top: 60px;
  left: 95px;
  border-radius: 10px;

  li{
    padding: 5px 10px;
    cursor: pointer; 
    width: 100%; 
    &:hover{
    background-color: rgb(237, 231, 231);

    }
    a{
      text-decoration: none;
      color:rgb(193, 187, 187);
       transition: .5s ease all;
       width: 100%;
      
    }
    &:hover a{
      color:black;
    } 
  } 
}
</style>

