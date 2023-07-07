import { Pagination } from './paginate.entity';

export class Global {
  tax = 0.04;
  fraisParKl = 0.5;
  apiURL = 'https://kgs-express.bestsol.tn/public/';
  logoURL = 'http://www.placehold.it/150x150/EFEFEF/AAAAAA?text=';
  defaultUserLogo = 'https://s3.amazonaws.com/uifaces/faces/twitter/jsa/128.jpg';
  siteName = 'KgsExpresse';
  telephone = '+21674852552';
  adresse = 'Avenue Monji Slim, Sakiet Ezzit';
  ville = 'sfax';
  private directionsService = new google.maps.DirectionsService();
  totalDistance ;
  totalTemps  ;
  verifLogo(urlLogo, nom) {
    if (urlLogo === '' || urlLogo === null) {
      return encodeURI(this.logoURL + nom);
    } else {
      return encodeURI(this.apiURL + urlLogo);
    }
  }
  logoUser(urlLogo) {
    let url = '';
    if (urlLogo === '' || urlLogo === null) {
      url = this.defaultUserLogo;
    } else {
      url = encodeURI(this.apiURL + urlLogo);
    }
    console.log(url);
    return url;
  }
  rateCode(n) {
    let code = '';
    for (let index = 0; index < 5; index++) {
      code += index < n ? '<i  class="fa fa-star"></i>' : '<i  class="fa fa-star-o"></i>';
    }
    return code;
  }
  paginate(meta) {
    const paginate = [];
    for (let index = 0; index < meta.last_page; index++) {
      paginate[index] = new Pagination();
      paginate[index].numPage = index + 1;
      paginate[index].pageUrl = '?page=' + (index + 1);
      paginate[index].currentPage = meta.current_page === index + 1;
      paginate[index].lastPage = meta.last_page === index + 1;
    }
    return paginate;
  }
  verifLogoBack(urlLogo, nom) {
    if (urlLogo === '') {
      return 'url(' + encodeURI(this.logoURL + nom) + ')';
    } else {
      return 'url(' + this.apiURL + urlLogo + ')';
    }
  }


  calcRoute(origins , end , destinations) {
    const waypts = [];
    // tslint:disable-next-line:prefer-for-of
    for (let i = 0; i < destinations.length ; i++) {
        waypts.push({
        location: destinations[i],
        stopover: true
        });
    }
    const request = {
        origin: origins,
        destination: end,
        waypoints: waypts,
        optimizeWaypoints: true,
        travelMode: google.maps.TravelMode.DRIVING
    };
    this.directionsService.route(request, this.getStats.bind(this));
  }


  getStats(response, status) {
    if (status === google.maps.DirectionsStatus.OK) {
     let totalDistance = 0.0;
     let totalTemps = 0 ;
    // tslint:disable-next-line:prefer-for-of
     for (let i = 0 ; i < response.routes[0].legs.length; i++) {
          totalDistance += response.routes[0].legs[i].distance.value;
          totalTemps += response.routes[0].legs[i].duration.value;
        }
     const hours = Math.floor(totalTemps / 3600);
     const minutes = Math.floor((totalTemps - (hours * 3600)) / 60);
     const seconds = totalTemps - (hours * 3600) - (minutes * 60);
     const timeString = hours.toString().padStart(2, '0') + ':' +
            minutes.toString().padStart(2, '0') + ':' +
            seconds.toString().padStart(2, '0');
     this.totalDistance =  totalDistance / 1000;
     this.totalTemps = timeString;
     console.log( this.totalDistance + ' ' + this.totalTemps);
    }
  }

}
