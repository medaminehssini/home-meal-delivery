import { Component, OnInit } from '@angular/core';
import { SearchService } from 'src/app/services/search.service';
import { Global } from 'src/app/entities/global.entity';
import { Router } from '@angular/router';
import { CartService } from 'src/app/services/cart.service';
import { Pagination } from 'src/app/entities/paginate.entity';

@Component({
  selector: 'app-repas-map',
  templateUrl: './repas-map.component.html',
  styleUrls: ['./repas-map.component.css']
})
export class RepasMapComponent implements OnInit {
  result = null;
  listSpecialite = null;
  packlistitem = null;
  global = new Global();
  type = 'repas';
  page = '?page=1';
  prix = 100;
  libelle = '';
  specialite = [];
  orderBy = '';
  repasdetails = null;
  tags = null;
  map = null;
  marker = null ;
  markersArray = [];
  loading = true;
  constructor(
    private search: SearchService,
    private router: Router,
    public cart: CartService
  ) {
    if (this.router.getCurrentNavigation().extras.state != null) {
      if (this.router.getCurrentNavigation().extras.state.id != null) {
        this.libelle = this.router.getCurrentNavigation().extras.state.libelle;
      }
    }

  }


  ngOnInit() {
    this.getSpecialite(this.libelle);
    (document.getElementById('SearchBox') as HTMLInputElement).value = this.libelle;
    this.getTags();
    this.getmap();
  }

  getmap() {

    this.map = new google.maps.Map(document.getElementById('map'), {
      zoom: 11,
      center: new google.maps.LatLng(JSON.parse(localStorage.getItem('pos')))
    });

  }

  getRepas() {
    this.loading = true;
    this.result = null;
    this.search.getRepas(this.type, this.page, this.prix, this.libelle, this.specialite, this.orderBy, 'paginate').subscribe(data => {

      this.result = data;
      this.loading = false;
    });
    this.search.getRepas(this.type, this.page, this.prix, this.libelle, this.specialite, this.orderBy, 'get').subscribe(data => {
      this.clearOverlays();
      Object(data).data.forEach(element => {
        this.marker = new google.maps.Marker({
          position: {
            lat: parseFloat(element.restaurant.lat),
            lng: parseFloat(element.restaurant.lng)
          },
          map: this.map,
          icon:  {
            url: this.global.apiURL + '/images/maps/destination.png',
            scaledSize : new google.maps.Size(50, 50),
          }
        });
        this.setMarkerContent(this.marker , element );
        this.markersArray[this.markersArray.length] = this.marker;
      });
    });
  }
  setMarkerContent(marker , item ) {
    const infoWindowOptions = {
                // tslint:disable-next-line:max-line-length
                content: '<img style="width:260px;height:143px" class="wwone__map-infobox__thumb" src="' + this.global.verifLogo(item.restaurant.logo, item.restaurant.nom) + '" />' +
                 '<div class="wwone__map-infobox__inner">' +
                 '<div class="wwone__map-infobox__inner__heading">' + item.restaurant.nom + '</div>' +
                 '<div class="wwone__map-infobox__inner__info"><div class="wwone__map-infobox__inner__info__type">' +
                 '<strong>Téléphone:</strong>' + item.restaurant.telephone + '</div><div class="wwone__map-infobox__inner__info__location">'
                 + '<strong>Adresse:</strong> ' + item.restaurant.adresse + '</div><div class="wwone__map-infobox__inner__info__date">' +
                 '<strong>Ville:</strong> ' + item.restaurant.ville + '</div></div>'
                 // tslint:disable-next-line:max-line-length
                 + '<a style="color:white;" class="wwone__map-infobox__inner__btn btn" id="restaurant' + item.restaurant.id + '" target="_blank">En savoir plus</a></div>'
            };


    const infoWindow = new google.maps.InfoWindow(infoWindowOptions);

    google.maps.event.addListener(infoWindow, 'domready', () => {

     const clickableItem = document.getElementById('restaurant' + item.restaurant.id);
     clickableItem.addEventListener('click', () => {
       this.goToRestaurantPage('/restaurant/' + item.restaurant.id);
     });
   });

    // tslint:disable-next-line:only-arrow-functions
    google.maps.event.addListener(marker, 'click', function() {
            infoWindow.open(this.map, marker);
    }.bind(this));
   }
   goToRestaurantPage(item) {
      console.log(item);
      this.router.navigate([item]);
   }
  clearOverlays() {
    // tslint:disable-next-line:prefer-for-of
    for (let i = 0; i < this.markersArray.length; i++ ) {
      this.markersArray[i].setMap(null);
    }
    this.markersArray.length = 0;
  }
  getTags() {
    this.search.getTags().subscribe(data => {

      this.tags = Object(data).data;
    });
  }

  getSpecialite(value) {
    this.libelle = value;
    this.getRepas();
    this.search.getSpecialite(value).subscribe(data => {
      this.listSpecialite = Object(data).data;
    });
  }
  verifLogo(urlLogo, nom) {
    if (urlLogo === '') {
      return 'url(' + encodeURI(this.global.logoURL + nom) + ')';
    } else {
      return 'url(' + this.global.apiURL + urlLogo + ')';
    }
  }

  setTags(mot) {
    const searchbox = document.getElementById('SearchBox') as HTMLInputElement;
    searchbox.value = mot;
    this.getSpecialite(mot);
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

  setValues(value) {
    this.libelle = value;
    this.getRepas();
    this.page = '?page=1';

  }

  setPrix(value) {
    this.prix = value;
    this.getRepas();
    this.page = '?page=1';
  }
  setType(type) {
    this.type = type;
    this.getRepas();
    this.page = '?page=1';
  }
  specialiteSearch(id) {
    this.specialite[0] = id;
    this.page = '?page=1';
    this.getRepas();
  }

  setPage(value) {
    this.page = value;
    this.getRepas();

  }

  changeOrder(value) {
    this.orderBy = value;
    this.getRepas();
  }

  setRepasdetails(repas) {
    this.repasdetails = repas;
  }
}
