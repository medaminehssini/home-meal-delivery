import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import * as moment from 'moment';
import { HttpClient } from '@angular/common/http';
import { Global } from 'src/app/entities/global.entity';
import { UserDataService } from 'src/app/services/user-data.service';
import { ToastrService } from 'ngx-toastr';

@Component({
  selector: 'app-list-order',
  templateUrl: './list-order.component.html',
  styleUrls: ['./list-order.component.css', '../app-user/app-user.component.css']
})
export class ListOrderComponent implements OnInit {
  selected: {start: moment.Moment, end: moment.Moment};
  global = new Global();
  listeCommande = null;
  orderDetails = null;
  userDetails = null;
  meta = null;
  pageUrl = '?page=1';
  getOnly = '';
  repasCommande = null;
  getListReview = null;
  constructor(
    private router: Router,
    private http: HttpClient,
    private dataUser: UserDataService,
    private toastr: ToastrService
    ) { }

  ngOnInit(): void {
    this.loadScripts('../../../../assets/js/chosen.js');
    this.loadScripts('../../../../assets/js/jquery.mCustomScrollbar.concat.min.js');
    this.loadScripts('../../../../assets/js/functions-plugin.js');
    this.loadScripts('../../../../assets/js/functions.js');
    this.getCommande();
    this.dataUser.currentMessage.subscribe(message => {
      this.userDetails = message ;
    });
  }
  public loadScripts(url) {
    const scriptTag = document.createElement('script');
    scriptTag.src = url;
    scriptTag.type = 'text/javascript';
    scriptTag.async = false;
    scriptTag.charset = 'utf-8';
    document.getElementsByTagName('head')[0].appendChild(scriptTag);
  }


  getCommande() {
    this.http.get(this.global.apiURL + 'api/commande' + this.pageUrl + '&getOnly=' + this.getOnly ).subscribe(
      success => {
        this.listeCommande = Object(success).success.commandes;
        this.meta =  Object(success).success.meta;
        console.log(success);
      },
      error => {
        console.log(error);
      }
    );
  }
  setEtat() {
    const status = this.orderDetails.status;
    switch (status) {
      case 'Accepté':
        return '#047a06';
      case 'En cour de laivraison':
         return '#ffbc00;';
      case 'Livré':
         return '#047a06';
      case 'Refusé':
        return '#13068b';
      default:
        return '#ffbc00;';
    }
  }
  setEtatCommande(ns) {
    this.pageUrl = '?page=1';
    this.getOnly = ns;
    this.getCommande();
  }
  setOrderDetails(data) {
    this.orderDetails = data;
  }
  setPage(numberPage) {
    this.pageUrl = numberPage;
    this.getCommande();
  }

  getVeview(commande) {
    this.repasCommande = commande;
    document.getElementById('reviwelist').style.height = 'auto';
    this.getListOldReview();
  }

  setReview( idrepas , notes ) {
    this.http.post(this.global.apiURL + 'api/note', { note : notes , id_repas : idrepas  }).subscribe(success => {
      this.toastr.success('votre avis a été envoyer avec succès');
    }, error => {
      this.toastr.error('veuillez réessayer');
    });
  }
  getListOldReview() {
    this.getListReview = null;
    let idrepas = '';
    this.repasCommande.repas.forEach(element => {
      idrepas += element.id + ',';
    });
    this.http.get(this.global.apiURL + 'api/get/note?repas=' + idrepas).subscribe(success => {
      this.getListReview = Object(success).success;
      console.log(success);
    }, error => {
      this.toastr.error('veuillez réessayer');
    });
  }
  verifReview(idrepas , note) {
    let verif = false;
    this.getListReview.forEach(element => {
     if (element.id_repas === idrepas && element.note === note) {
       verif = true;
     }
    });
    return verif;
  }
}
