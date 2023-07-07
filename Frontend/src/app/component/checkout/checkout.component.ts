import { Component, OnInit } from '@angular/core';
import { CartService } from 'src/app/services/cart.service';
import { Global } from 'src/app/entities/global.entity';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import { HttpClient } from '@angular/common/http';
import { ToastrService } from 'ngx-toastr';
import { Router } from '@angular/router';
import { UserDataService } from 'src/app/services/user-data.service';

@Component({
  selector: 'app-checkout',
  templateUrl: './checkout.component.html',
  styleUrls: ['./checkout.component.css']
})
export class CheckoutComponent implements OnInit {
  couponLoading = false;
  coupon = null;
  errors = null;
  isNewAdress = false;
  NewAdress = null;
  user = null;
  pos ;
  isclicked = true;
  marker;
  private directionsService = new google.maps.DirectionsService();
  totalDistance ;
  totalTemps  ;
  adressForm = new FormGroup({
    number       : new FormControl('', [ Validators.maxLength(15), Validators.minLength(15)]),
    code         : new FormControl('', [ Validators.maxLength(2), Validators.minLength(2)]),
    ans          : new FormControl('', [ Validators.maxLength(2), Validators.minLength(2)]),
    mois         : new FormControl('', [ Validators.maxLength(15), Validators.minLength(3)]),
  });
  global = new Global();
  positionCommandeRestaurnt = [];
  loading = false;
  constructor(
    public cart: CartService,
    private http: HttpClient,
    private router: Router,
    private dataUser: UserDataService,
    private toast: ToastrService
  ) { }

  ngOnInit(): void {
    if (localStorage.getItem('cart')) {
        if (this.cart.cartToArray().length < 1) {
          this.toast.error('Un / des repas doit être sélectionné');
          this.router.navigate(['/home']);
        }
    } else {
        this.toast.error('Un / des repas doit être sélectionné');
        this.router.navigate(['/home']);
    }
    this.dataUser.currentMessage.subscribe(data => {
      this.user = data;
      this.getRestauInfo();
    });

  }
  verifIsCreditCard() {
    const input = document.getElementById('inputCreditCart') as HTMLInputElement;

  }





  verifIsNewAdress() {
    const input = document.getElementById('inputNewAdress') as HTMLInputElement;
    input.checked ? this.isNewAdress = true : this.isNewAdress = false;

  }
  onSubmit() {
    const input = document.getElementById('inputNewAdress') as HTMLInputElement;
    if (input.checked ) {
      this.addCommande(input.checked);
    } else {
      this.addCommande(false);
    }
  }


  setCoupon() {
    this.couponLoading = true;
    const coup = (document.getElementById('CodeCoupon') as HTMLInputElement).value;
    this.http.get(this.global.apiURL + '/api/coupon/info?code=' + coup).subscribe(
      success => {
        this.coupon = Object(success).success;
        this.couponLoading = false;
        this.toast.success('Le code de promo a été appliqué avec succès');

      }, error => {
        this.couponLoading = false;
        this.toast.error('Le code de promo est non valide');

      }
    );
  }
  strSub(str) {
    return String(str).substr(0, 6);
  }

  addCommande(verif) {
    this.loading = true;
    this.isclicked = false;

    const carts = this.cart.cartToArray();
    let data = null;
    if (!this.NewAdress && !(this.user.lat && this.user.lang)  ) {
      this.toast.error('voulez-vous vérifier votre adresse');
      return;
    }
    if (this.isNewAdress) {
      data = {
        lat  : this.NewAdress.lat,
        lang : this.NewAdress.lng,
        repas : JSON.stringify(carts),
        ville : localStorage.getItem('ville'),
        temps: this.totalTemps,
        distance: this.totalDistance,
        coupon : this.coupon ? this.coupon.id : '',
        // tslint:disable-next-line:max-line-length
        prix : this.coupon ? this.cart.getTotalTva() + this.global.fraisParKl * this.totalDistance - this.cart.getTotalTva() * (this.coupon.remise / 100)  : this.cart.getTotalTva() + this.global.fraisParKl * this.totalDistance
      };
    } else {
      data = {
        lat : this.user.lat,
        lng : this.user.lang,
        repas : JSON.stringify(carts),
        ville : localStorage.getItem('ville'),
        temps: this.totalTemps,
        distance: this.totalDistance,
        coupon : this.coupon ? this.coupon.id : '',
        // tslint:disable-next-line:max-line-length
        prix : this.coupon ? this.cart.getTotalTva() + this.global.fraisParKl * this.totalDistance - this.cart.getTotalTva() * (this.coupon.remise / 100)  : this.cart.getTotalTva() + this.global.fraisParKl * this.totalDistance

      };
    }
    this.http.post(this.global.apiURL + 'api/commande' , data).subscribe(success => {
      this.toast.success('Votre commande a bien été enregistrée');
      this.cart.removeAllCart();
      this.cart.loadCart();
      this.loading = false;
      this.router.navigate(['/user/order-list']);
    }, error => {
      this.loading = false;
      this.isclicked = true;
      console.log(error);
      this.errors = Object(error).error.error;
      this.toast.error('Verifier votre donnée');

    }

    );
  }

  getRestauInfo() {
    const carts = JSON.parse(localStorage.getItem('cart'));
    let pack = '';
    let repas = '';
    let i = 0 ;
    let j = 0 ;
    carts.forEach(element => {
      if (JSON.parse(element).product.type === 'repas') {
        if (i  !== 0) {
          repas += ',';
        }
        i++;
        repas += JSON.parse(element).product.id ;

      } else {
        if (j  !== 0) {
          pack += ',';
        }
        j++;
        pack += JSON.parse(element).product.id;
      }
    });
    i = 0;
    this.http.get(this.global.apiURL + '/api/commande/retaurant?repas=' + repas + '&pack=' + pack).subscribe(success => {
      Object(success).success.forEach(element => {
        const pos = {
          lng: parseFloat(element.lng),
          lat: parseFloat(element.lat)
        };
        this.positionCommandeRestaurnt[i] = pos;
        i++;
      });
      this.prepareCalculeRoute();
    });

  }

  prepareCalculeRoute() {
    this.totalTemps = null;
    this.totalDistance = null;
    let or;
    if (this.isNewAdress && this.NewAdress) {
       or = this.NewAdress;
    } else if (this.pos && !this.isNewAdress ) {
       or = this.pos;
    } else {
       or = {
        lng: parseFloat(this.user.lang),
        lat: parseFloat(this.user.lat)
      };
    }
    console.log(or);
    console.log(this.positionCommandeRestaurnt);

    this.calcRoute(or, or, this.positionCommandeRestaurnt);
  }


  setAjoutMap() {
    const poss = JSON.parse(localStorage.getItem('pos'));
    if (!this.pos) {
      this.pos  = poss;
    }
    const options = {
      center: new google.maps.LatLng(poss.lat, poss.lng),
      zoom: 18,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    const maps = new google.maps.Map(document.getElementById('AjoutMaps'), options);
    this.marker = new google.maps.Marker({
      position: new google.maps.LatLng(poss.lat, poss.lng),
      map: maps,
      title: 'Votre nouveau Adresse'
    });

    google.maps.event.addListener(maps, 'click', this.setMarker.bind(this));

  }

  setMarker(event) {
      this.marker.setPosition(event.latLng);
      this.pos = {
        // tslint:disable-next-line:object-literal-key-quotes
        'lat' : event.latLng.lat(),
        // tslint:disable-next-line:object-literal-key-quotes
        'lng' : event.latLng.lng()
      };
  }

  changeNewAdresse() {
    this.NewAdress = {
      // tslint:disable-next-line:object-literal-key-quotes
      lat : this.pos.lat,
      // tslint:disable-next-line:object-literal-key-quotes
      lng : this.pos.lng
    };
    this.prepareCalculeRoute();
    document.getElementById('closeAjoutadresse').click();
    }

  setVoiradresse() {
    let lat = 0 ;
    let lng = 0;
    if (this.isNewAdress) {
      lat = this.NewAdress.lat;
      lng = this.NewAdress.lng;
    } else {
      lat = this.user.lat;
      lng = this.user.lang;
    }
    const options = {
      center: new google.maps.LatLng(lat, lng),
      zoom: 18,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    const maps = new google.maps.Map(document.getElementById('VoirMaps'), options);
    const marker = new google.maps.Marker({
      position: new google.maps.LatLng(lat, lng),
      map: maps,
      title: 'Votre Adresse'
    });
  }
  editPosition() {
    this.prepareCalculeRoute();
    if (this.pos) {
      this.http.post(this.global.apiURL + '/api/edit/latLng', this.pos).subscribe(success => {
        this.dataUser.getData();
        this.toast.success('Votre Position a été ajouter avec succès');
        document.getElementById('closeAjoutadresse').click();
      }, error => {
        this.toast.error('voulez-vous vérifier votre adresse');

      });
    } else {
      this.toast.error('voulez-vous vérifier votre adresse');
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
     let totalDistances = 0.0;
     let totalTempss = 0 ;
    // tslint:disable-next-line:prefer-for-of
     for (let i = 0 ; i < response.routes[0].legs.length; i++) {
          totalDistances += response.routes[0].legs[i].distance.value;
          totalTempss += response.routes[0].legs[i].duration.value;
        }
     const hours = Math.floor(totalTempss / 3600);
     const minutes = Math.floor((totalTempss - (hours * 3600)) / 60);
     const seconds = totalTempss - (hours * 3600) - (minutes * 60);
     const timeString = hours.toString().padStart(2, '0') + ':' +
            minutes.toString().padStart(2, '0') + ':' +
            seconds.toString().padStart(2, '0');
     this.totalDistance =  totalDistances / 1000;
     this.totalTemps = timeString;
    }
  }

}
