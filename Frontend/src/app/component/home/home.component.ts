import { Component, OnInit } from '@angular/core';
import { Title } from '@angular/platform-browser';
import { HomeService } from 'src/app/services/home.service';
import { HttpClient } from '@angular/common/http';
import { ScriptService } from 'src/app/script-service.service';
import { Global } from 'src/app/entities/global.entity';
import { SearchService } from 'src/app/services/search.service';
import { Router } from '@angular/router';
import { OwlOptions } from 'ngx-owl-carousel-o';
import { CartService } from 'src/app/services/cart.service';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {
  constructor(
    private titleServ: Title,
    public cart: CartService,
    private search: SearchService,
    private http: HttpClient,
    private router: Router
  ) {

  }
  city ;
  title = 'Accueil';
  Repas = null;
  meta = null;
  restaurants: any = null;
  loadAPI: any;
  global = new Global();
  specialiteList;
  url = this.global.apiURL;
  isOpenSearch = false;
  specialiteResult = null;
  idSpecialite = null;
  customOptions: OwlOptions = {
    loop: true,
    mouseDrag: true,
    touchDrag: true,
    pullDrag: true,
    autoplay: true,
    nav: true,
    dots: false,
    navSpeed: 700,
    navText: ['<', '>'],
  };


  ngOnInit() {
    this.titleServ.setTitle(this.title + ' ' + this.global.siteName);
  }
  getDataWithCity() {

    if (localStorage.getItem('ville')) {
      if (!this.city) {
        this.getRestaurants(localStorage.getItem('ville'));
        this.getRepas();
      }
      this.city = localStorage.getItem('ville');
      return true;
    } else {
      return false;
    }
  }
  verifCity(city , city2) {
      if (String(city2).toLowerCase().search(city.toLowerCase()) === -1) {
        return false;
      } else {
        return true;
      }
  }


  getRepas() {
    this.http.get(this.url + 'api/list/repas').subscribe(
      data =>
        this.Repas = Object(data).data
    );
  }

  getRestaurants(ville) {
    this.http.get(this.url + 'api/list/restaurant?ville=' + ville).subscribe(
      data => {
        this.restaurants = Object(data).data;
        this.meta  = Object(data).meta;
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

  getClass(classes) {
    let listeClasse = ' ';
    classes.forEach(classe => {
      listeClasse += classe;
      listeClasse += ' ';
    });
    return listeClasse;
  }
  getSpecialiteList() {
      this.search.getSpecialite('').subscribe(data => {
        this.specialiteList = Object(data).data;
        this.isOpenSearch = true;
      });
  }
  verifLogo(urlLogo, nom) {
    if (urlLogo === '') {
      return this.global.logoURL + nom;
    } else {
      return this.url + urlLogo;
    }
  }
  selectSearch(event, id) {
    (document.getElementById('searchContent') as HTMLInputElement).value = event.srcElement.innerHTML;
    this.idSpecialite = id;
    this.isOpenSearch = false;
  }

  getSpecialite(value) {
    this.idSpecialite = null;
    if (value !== '') {
      this.search.getSpecialite(value).subscribe(data => {
        this.specialiteResult = Object(data).data;
        this.isOpenSearch = true;
      });
    } else {
      this.isOpenSearch = false;
    }
  }

  gotoSearch(val) {
    this.router.navigateByUrl('/search/repas', { state: { id: this.idSpecialite, libelle: val } });
  }





}
