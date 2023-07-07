import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { HttpClient } from '@angular/common/http';
import { Product } from 'src/app/entities/cart/product.entity';
import { Global } from 'src/app/entities/global.entity';
import { ProductService } from 'src/app/services/product.service';
import { CartService } from 'src/app/services/cart.service';

@Component({
  selector: 'app-restaurant-profile',
  templateUrl: './restaurant-profile.component.html',
  styleUrls: ['./restaurant-profile.component.css']
})
export class RestaurantProfileComponent implements OnInit {

  id = null;
  restaurant: any;
  color = false;
  filterText;
  repas = true;
  activeButton;
  global = new Global();
  constructor(
    private route: ActivatedRoute,
    private http: HttpClient,
    public cart: CartService
  ) { }

  ngOnInit() {
    this.id = this.route.snapshot.paramMap.get('id');
    this.getRestaurant();
    this.cart.loadCart();
  }



  getRestaurant() {
    this.http.get(this.global.apiURL + 'api/restaurant/' + this.id).toPromise().then(
      data => {
        this.restaurant = Object(data).data;
      }
    );
  }

  rateCode(n) {
    let code = '';
    for (let index = 0; index < 5; index++) {
      code += index < n ? '<i  class="fa fa-star"></i>' : '<i  class="fa fa-star-o"></i>';
    }
    return code;
  }
  getSpecialite(specialites) {
    let listeSpecialite = ' ';
    specialites.forEach(specialite => {
      listeSpecialite += specialite.nom;
      listeSpecialite += ', ';
    });
    return listeSpecialite;
  }
  verifLogo(urlLogo, nom) {
    if (urlLogo === '') {
      return 'http://www.placehold.it/150x150/EFEFEF/AAAAAA?text=' + nom;
    } else {
      return this.global.apiURL + urlLogo;
    }
  }

  changeColor() {
    this.color = !this.color;
  }
  filterRepasOfType(id) {
    return this.restaurant.repas.filter(x => x.specialite.id === id);
  }
  setSearch(num) {
    if (this.filterText === '' + num) {
      this.filterText = '';
    } else {
      this.filterText = '' + num;
    }
  }
  activeClass(elem) {
    const classAc = document.getElementsByClassName('scroll');
    // tslint:disable-next-line:prefer-for-of
    for (let index = 0; index < classAc.length; index++) {
      classAc[index].classList.remove('active');
    }
    elem.classList.add('active');
  }
  setActive(buttonName) {
    if (buttonName === this.activeButton) {
      this.activeButton = null;
    } else {
      this.activeButton = buttonName;
    }
  }
  isActive(buttonName) {
    return this.activeButton === buttonName;
  }
  getBackground(restaurant) {
    if (restaurant.repas.length > 0) {
      return 'url(' + this.verifLogo(restaurant.repas[0].image, '') + ')';
    } else {
      return 'url(' + this.global.apiURL + '/images/repas/slide1.jpg' + ')';
    }
  }
}
