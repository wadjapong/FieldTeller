import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state:{
    username:'Hello',
    role:'',
    userDetails:'',
    userLastname:'',
    userId:'',
    cookies:'',
    token:null,
    showLogin:false,
    domain:'localhost:8000',//'https://fb.bitsweaver.net/ghhospitals',//'localhost:8000',
    storagePath: 'http://localhost:8000/api/imagestorage/', //'https://fb.bitsweaver.net/ghhospitals/public/api/imagestorage/', //,
    audioStoragePath: 'https://fb.bitsweaver.net/ghhospitals/public/api/audiostorage/',//'http://localhost:8000/api/audiostorage/',
    videoStoragePath: 'https://fb.bitsweaver.net/ghhospitals/public/api/videostorage/',//'http://localhost:8000/api/videostorage/',
  },
  getters:{
      getUserDetails:state => state.userDetails,
      getCookies:state=>state.cookies,
      getToken:state=>state.token,
      getShowLogin:state=>state.showLogin,
      getStoragePath:state=>state.storagePath,
      getAudioStoragePath:state=>state.audioStoragePath,
      getVideoStoragePath:state=>state.videoStoragePath,
      getDomain:state=>state.domain
  },
  mutations:{
      setUserDetails(state,value){
        state.userDetails = value
      },
      setCookies(state,value){
          state.cookies = value
      },
      setToken(state,value){
          state.token = value
      },
      setShowLogin(state,value){
          state.showLogin = value
      },
      setFacilitiesData(state,value){
          state.facilitiesData = value
      }
  },
  actions: {
    
  }
})
