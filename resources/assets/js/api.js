import { Notification } from 'element-ui';
import api from 'axios'

export default {
  request (method, url, data, succCb = null, errCb = null) {
    return api({
      method: method,
      url: '/backend/' + url,
      data: data,
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
      }
    })
    .then(success => {
      if (succCb) succCb(success)
    })
    .catch(error => {
      if (error.response) {
        Notification({
          title: 'Error', type: 'error', message: error.response.statusText
        })
      }
      if (errCb) errCb(error)
    })
  },

  get (url, data = {}, succCb = null, errCb = null) {
    return this.request('GET', url, data, succCb, errCb)
  },

  post (url, data = {}, succCb = null, errCb = null) {
    return this.request('POST', url, data, succCb, errCb)
  },

  put (url, data = {}, succCb = null, errCb = null) {
    return this.request('PUT', url, data, succCb, errCb)
  },

  delete (url, data = {}, succCb = null, errCb = null) {
    return this.request('DELETE', url, data, succCb, errCb)
  },

  init () {

  }
}
