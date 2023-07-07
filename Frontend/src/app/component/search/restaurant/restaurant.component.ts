import { Component, OnInit } from '@angular/core';
import { RestaurantSearchService } from 'src/app/services/search/restaurant-search.service';
import { Pagination } from 'src/app/entities/paginate.entity';
import { SearchService } from 'src/app/services/search.service';

@Component({
  selector: 'app-restaurant',
  templateUrl: './restaurant.component.html',
  styleUrls: ['./restaurant.component.css']
})
export class RestaurantComponent implements OnInit {
  restaurants = null;
  page = '?page=1';
  nom = '';
  specialites = null;
  specialite = [];
  isloadedImage = false;
  tags = '';
  loading = true;
  constructor(
    public restaurantSearch: RestaurantSearchService,
    private search: SearchService
  ) { }

  ngOnInit() {
    this.getRestaurants();
    this.getSpecialite();
    this.getTags();
  }

  getRestaurants() {
    this.loading = true;
    this.restaurantSearch.getRestaurants(this.page, this.nom, this.specialite).subscribe(
      data => {
        this.restaurants = Object(data);
        this.loading = false;

      }
    );
  }
  getSpecialite() {
    this.search.getSpecialite(this.nom).subscribe(
      data => {
        this.specialites = Object(data).data;
      }
    );
  }

  setTags(mot) {
    const searchbox = document.getElementById('SearchBox') as HTMLInputElement;
    searchbox.value = mot;
    this.nom =  mot;
    this.getSpecialite();
    this.getRestaurants();
  }
  getTags() {
    this.search.getTags().subscribe(data => {

      this.tags = Object(data).data;
    });
  }
  setSpecialite(specialites) {
    let result = '';
    // tslint:disable-next-line:prefer-for-of
    for (let index = 0; index < specialites.length; index++) {
      result += specialites[index] + ', ';

    }
    return result;
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
  setPage(value) {
    this.page = value;
    this.getRestaurants();

  }

  setNom(nom) {
    console.log(nom);
    this.nom = nom;
    this.page = '?page=1';
    this.getRestaurants();
    this.getSpecialite();
  }

  specialiteSearch(id, check) {
    if (check) {
      this.specialite.push(id);
    } else {
      let i = 0;
      this.specialite.forEach(element => {
        if (element === id) {
          this.specialite.splice(i, 1);
        }
        i++;
      });
    }
    this.page = '?page=1';
    this.getRestaurants();
  }

  getrandomImage() {
    if (!this.isloadedImage) {
      const rand = Math.floor(Math.random() * Math.floor(this.specialites.length));
      console.log(this.restaurantSearch.global.verifLogo(this.specialites[rand].image, this.specialites[rand].libelle));
      this.isloadedImage = true;
      return this.restaurantSearch.global.verifLogo(this.specialites[rand].image, '');
    }
  }
}
