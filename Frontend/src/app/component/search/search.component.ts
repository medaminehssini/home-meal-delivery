import { Component, OnInit } from '@angular/core';
import { SearchService } from 'src/app/services/search.service';
import { Global } from 'src/app/entities/global.entity';
import { Pagination } from 'src/app/entities/paginate.entity';
import { Router } from '@angular/router';
import { CartService } from 'src/app/services/cart.service';

@Component({
  selector: 'app-search',
  templateUrl: './search.component.html',
  styleUrls: ['./search.component.css']
})



export class SearchComponent implements OnInit {

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
  }

  getRepas() {
    this.result = null;
    this.loading = true;
    this.search.getRepas(this.type, this.page, this.prix, this.libelle, this.specialite, this.orderBy, 'paginate').subscribe(data => {

      this.result = data;
      this.loading = false;
    });
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
