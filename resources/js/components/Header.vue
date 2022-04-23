<template>
    <header class="container-fluid" :class="{ 'is-hidden': !scrollEffect }">
        <div class="row">
          <div class="header-container col-12">

            <!-- header left -->
            <div class="col-3 d-none d-xl-block headerleft" :class="{ 'pink': scrollEffect }">
                <i class="fa-brands fa-airbnb"></i>
                <span>Boolbnb</span>
            </div>

            <!-- header center -->
            <div class="col-12 col-xl-5 headercenter d-flex flex-column align-items-center m-auto">
                <nav :class="{ 'hide': scrollEffect }">
                <ul>
                    <li><router-link :to="{ name: 'Homepage' }">Homepage</router-link></li>
                    <li><router-link :to="{ name: 'ApartmentList' }">Appartamenti</router-link></li>
                </ul>
                </nav>
                <div class="d-flex headercenterB justify-content-center m-auto">
                    <div class="inputContainer col-12 d-flex justify-content-between" @keyup.enter.stop="filter" :class="{ 'search': scrollEffect }">
                      <input class="col-8 ml-4"  type="text" v-model="search" @input="autocomplete" value="choosedSearch">
                      <div class="col-2 p-0 ms_icon"><i @click.stop="filter" class="fa-solid fa-magnifying-glass searchIcon"></i></div>
                      <div class="autocompleters" v-show="autocompleters">
                        <div class="option" v-for="(option, index) in autocompleters" :key="index" @click="setSearch(index)">
                            {{option.address.freeformAddress}}, {{option.address.municipality}}, {{option.address.countrySecondarySubdivision}}
                        </div>
                      </div>                           
                    </div>                 
                </div>
            
            <!-- campi aggiuntivi -->
              <div class="ms_options col justify-content-around filter">
                    <label for="rooms">Numero di Stanze</label>
                      <select id="rooms" name="rooms_number" >
                        <option value="">-</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                      </select>
                    <label for="beds">Numero di Letti</label>
                      <select id="beds" name="beds_number" >
                        <option value="">-</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                      </select>
                    <label for="range">Raggio di Ricerca</label>
                      <select id="range" name="range_number">
                        <option value="10">10 km</option>
                        <option value="20" selected="selected">20 km</option>
                        <option value="25">25 km</option>
                        <option value="30">30 km</option>
                        <option value="35">35 km</option>
                      </select>
                  </div>
              </div>
            
            <!-- header right -->
            <div class="headerright d-none d-lg-block col-3">
                <ul>
                <li>Diventa un Host</li>
                <li><i class="fa-solid fa-globe"></i></li>
                <li><button><i class="fa-solid fa-bars m-2"></i><i class="fa-solid fa-user m-2"></i></button></li>
                </ul>
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
        autocompleters:[]
    }
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
    //autocomplete
    autocomplete(){
      axios
        .get("https://cors-anywhere.herokuapp.com/https://api.tomtom.com/search/2/search/"+this.search+".json?key=5EIy0DQg5tZyBLLvAxNfCI6ei8DPGcte&typeahead=true&limit=5&countrySet=IT&language=it-IT")
        .then((response) => {
          this.autocompleters = response.data.results;
        });             
    },
    setSearch(index){
      this.search = this.autocompleters[index].address.freeformAddress +", " + this.autocompleters[index].address.municipality;
      this.searchLat = this.autocompleters[index].position.lat;
      this.searchLon = this.autocompleters[index].position.lon;
      this.autocompleters = [];
    },
    filter(){
      this.autocompleters = [];
      this.$emit('filter',{"search": this.search,"lat":this.searchLat,"lon":this.searchLon});              
    },
 
    // Toggle if navigation is shown or hidden
    onScroll() {
      if (window.pageYOffset < 0) {
        return
      }
      this.scrollEffect =  this.lastScrollPosition < window.pageYOffset
    },
  },
  props: {
    
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="scss">

header{
  position: fixed;
  top: 0;
  width: 100%;
  height: 125px;
  background-color: white;
  color: black;
  transition: .5s ease all; 
  z-index: 1000;
  .header-container{
    position:relative;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 20px;
    .headerleft{
      font-size: 26px;
      font-weight: 500;
      padding-left: 7%;
    }
    .headercenter{
      nav{
        ul{
          display: flex;
          list-style: none;
          li{
            margin: 10px;
            border-bottom: 1px black;
            a{
              cursor: pointer;
              color:white;  
            }
          }
        }
      }
      .headercenterB{
        width: 460px;

          .inputContainer{
            border:1px solid gray;
            .ms_icon{
              display: flex;
              justify-content: end;
              width: 30px;
              align-items: center;
              .searchIcon{
                  background-color: #ff385c;
                  border-radius: 50%;
                  color: white;
                  padding: 15px;
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
          margin: 10px;
          button{
            border: none;
            border-radius: 35px;
            padding: 2px;
            width: 90px;
            display: flex;
            align-items: center;
            justify-content: center;
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
    height: 153px;
}
.pink{
  color:#ff385c;
}
.hide{
  display: none;
}
.search{
  border:1px solid black;
  width: 300px; 
}

.autocompleters{
  background-color: white;
  color:black;
  width:100%;
  position:absolute;
  top:52px;
  left:50%;
  transform: translateX(-50%);

  .option{
    border-bottom:1px solid black;  
  }
}

input:focus, textarea:focus, select:focus{
  outline: none;
}
.filter{
  padding: 10px 0;
}


.ms_options{
  min-width: 500px;
  text-align: center;
  label{
    font-size: 12px;
    select{
      height: 25px;
    }
  }
}
@media only screen and (min-width:768px){
  .ms_options{
  min-width: 800px;
  text-align: center;
  label{
    font-size: 15px;
    select{
      height: 25px;
    }
  }
}

}
</style>

