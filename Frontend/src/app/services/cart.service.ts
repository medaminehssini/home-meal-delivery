import { Injectable } from '@angular/core';
import { Item } from '../entities/cart/item.entity';
import { ProductService } from './product.service';
import { Product } from '../entities/cart/product.entity';
import { HttpClient } from '@angular/common/http';
import { Global } from '../entities/global.entity';
import { ToastrService } from 'ngx-toastr';

@Injectable()
export class CartService {
  private tva = 0.04;
  total = 0;
  items: Item[];
  numberItem = 0;
  global = new Global();
  constructor(
    private http: HttpClient,
    private toastr: ToastrService

  ) { }



  addToCart(repas) {
    const product = new Product();
    product.id = repas.id;
    product.name = repas.libelle;
    product.prix = repas.prix;
    product.photo = repas.image;
    product.type = (repas.type).toLowerCase();

    let cart: any = [];
    if (localStorage.getItem('cart') != null) {

      cart = JSON.parse(localStorage.getItem('cart'));
      let index = -1;
      for (let i = 0; i < cart.length; i++) {

        const itemTest: Item = JSON.parse(cart[i]);

        if (itemTest.product.id === product.id) {
          index = i;
          break;

        }

      }

      if (index === -1) {

        this.addtoStorage(product, cart);

      } else {

        const item: Item = JSON.parse(cart[index]);
        item.quantity++;
        cart[index] = JSON.stringify(item);
        localStorage.setItem('cart', JSON.stringify(cart));

      }

    } else {
      this.addtoStorage(product, cart);
    }
    this.showSuccess(product);
    this.loadCart();
  }


  showSuccess(product) {
    this.toastr.success(  product.prix + ' TND' , product.name + ' a été ajouté avec succès');
  }
  addtoStorage(product, cart) {
    const item = this.getProductFromApi(product);
    cart.push(JSON.stringify(item));
    localStorage.setItem('cart', JSON.stringify(cart));
  }



  getProductFromApi(products: Product) {
    const item: Item = {
      product: products,
      quantity: 1
    };
    return item;
  }



  loadCart() {
    if (localStorage.getItem('cart')) {
      this.total = 0;
      this.items = [];
      const cart = JSON.parse(localStorage.getItem('cart'));
      // tslint:disable-next-line:prefer-for-of
      for (let i = 0; i < cart.length; i++) {
        const item = JSON.parse(cart[i]);
        this.items.push({
          product: item.product,
          quantity: item.quantity
        });
        this.total += item.product.prix * item.quantity;
      }
      this.numberItem = this.items.length;
    } else {
      this.total = 0;
      this.numberItem = this.items.length;
      this.items = [];
    }
  }

  removeCart(id: string) {
    if (localStorage.getItem('cart')) {
      const cart: any = JSON.parse(localStorage.getItem('cart'));
      for (let i = 0; i < cart.length; i++) {
        const item: Item = JSON.parse(cart[i]);
        if (item.product.id === id) {
          cart.splice(i, 1);
          break;
        }
      }
      localStorage.setItem('cart', JSON.stringify(cart));
      this.loadCart();
    }
  }
  updateCart(id: string, value: number) {
    if (localStorage.getItem('cart')) {
      if (value > 0) {
        const cart: any = JSON.parse(localStorage.getItem('cart'));
        let index = -1;
        for (let i = 0; i < cart.length; i++) {
          // tslint:disable-next-line:no-shadowed-variable
          const item: Item = JSON.parse(cart[i]);
          if (item.product.id === id) {
            index = i;
            break;
          }
        }
        const item: Item = JSON.parse(cart[index]);
        item.quantity = value;
        cart[index] = JSON.stringify(item);
        localStorage.setItem('cart', JSON.stringify(cart));
        this.loadCart();
      } else {
        this.removeCart(id);
      }
    }
  }
  removeAllCart() {
    localStorage.removeItem('cart');
    this.loadCart();
  }
  cartToArray() {
    let cartArray = null;
    if (localStorage.getItem('cart')) {
      cartArray = [];
      const cart: any = JSON.parse(localStorage.getItem('cart'));
      for (let i = 0; i < cart.length; i++) {
        const item: Item = JSON.parse(cart[i]);
        cartArray[i] = item.product.id;
      }
    }
    return cartArray;
  }
  getTVA() {
    return this.total * this.tva ;
  }
  getTotalTva() {
    return this.total + this.getTVA();
  }
}
