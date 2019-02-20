<template>
<div v-if="restaurants.length" class='row'>
  <div id="location_component">
    <div class='location_component_inner'>

      <h2 class="title">Nearby Restaurant</h2>

      <div v-for="restaurant in restaurants">
        <a class="single_restaurant" :href='`${app_url}/${restaurant.name}?comingByNearby=true`'>
          <div>
            <img :src="generateImageLink(restaurant)" alt='logo_image'/>
          </div>
          <div class='single_restaurant_content'>
            <h2>{{restaurant.title ? restaurant.title : restaurant.name}}</h2>
            <p>{{restaurant.address}}</p>
            <p>Distance from your place about <span style="font-weight: bold;">{{Math.ceil(restaurant.distance)}}km</span> </p>
          </div>
        </a>
      </div>
    </div>
  </div>
</div>
</template>
<script>
export default {
  data: function () {
    return {
      restaurants: [],
      warning: '',
      latitude: null,
      longitude: null,
    }
  },
  props: ['app_url', 'asset_domain'],
  methods: {

   getAllRestaurants: function () {
      axios.get(`${this.app_url}/restaurant/all`)
      .then(response => {
        console.log(response.data);
      })
      .catch(error => console.log('error', error))
   },
   getRestaurantByCoords: function (lat, lon) {
    axios.post(`${this.app_url}/restaurant/bycoords`, {lat, lon})
    .then((response) => {
      this.restaurants = response.data;
    })
    .catch(response => console.log(response))
   },
   generateImageLink: function (restaurant) {
     if (restaurant.logo) {
        return `${this.asset_domain}/storage/uploads/${restaurant.logo}`;
      }else {
        return `${this.app_url}/front/images/loader.png`;
      }
   },

  getGeoLocation: function () {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(this.showPosition);
    }else {
      this.warning = "Geolocation is not supported by this browser.";
    }
  },

  showPosition: function (position) {
    var lat = position.coords.latitude;
    var lon = position.coords.longitude;
    this.latitude = lat
    this.longitude = lon
    this.getRestaurantByCoords(lat, lon);
  }

  },

  mounted: function () {
    this.getGeoLocation();
  }
}

</script>

<style lang="scss">
#location_component {
  width: 100%;
  padding: 25px 15px;
  //background: #191919;
  padding: 5px 20px;
  text-align: center;
  display: flex;
  justify-content: center;
  .location_component_inner {
    background: #fcfcfc;
    max-width: 600px;
    -webkit-box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.08), 0px 0px 4px rgba(0, 0, 0, 0.05);
    box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.08), 0px 0px 4px rgba(0, 0, 0, 0.05);
    border-radius: 2px;
    margin: 1em 0;
    max-height: 300px;
    padding: 10px;
    overflow: scroll;
    h2.title {
      font-family: 'Playball', cursive;
      font-size: 30px;
      color: #C59D5F;
      margin-bottom: 20px;
    }
  }
  .single_restaurant {
    display: flex;
    margin-bottom: 15px;
    border-bottom: 1px solid #eee;
    &:last-child {
      border: none;
    }
    &:hover {
      text-decoration: none;
    }
    img {
      max-width: 150px;
      max-height: 150px;
      @media screen and (max-width: 480px) {
        max-width: 100px;
        max-height: 100px;
      }
      border-radius: 5px;
      background: #c59d5f;
      padding: 2px;
    }
    .single_restaurant_content {
      text-align: left;
      margin-left: 15px;
      h2 {
        color: #333;
        font-size: 20px;
      }
      p {
        color: #555;
        font-size: 14px;
        padding-bottom: 0;
      }
    }
  }
}



  .input-group-wrapper {
    display: flex;
    justify-content: center;
    .input-group {
      max-width: 600px;
      display: flex;
      .input-addon {
        padding: 5px 10px;
        box-sizing: border-box;
        background-color: #e2e8f5;
        color: #c59d5f;
        display: flex;
        justify-content: center;
        align-items: center;
        border-bottom-left-radius: 5px;
        border-top-left-radius: 5px;
        font-size: 16px;
      }
      input {
        padding: 5px 10px;
        box-sizing: border-box;
        border-bottom-right-radius: 5px;
        border-top-right-radius: 5px;
      }
    }
  }
</style>
