import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { HomeComponent } from './component/home/home.component';
import { EditComponent } from './component/user/edit/edit.component';
import { RestaurantProfileComponent } from './component/restaurant-profile/restaurant-profile.component';
import { SearchComponent } from './component/search/search.component';
import { RestaurantComponent } from './component/search/restaurant/restaurant.component';
import { ContactComponent } from './component/contact/contact.component';
import { AuthGuard } from './guard/auth.guard';
import { CheckoutComponent } from './component/checkout/checkout.component';
import { DashboardComponent } from './component/user/dashboard/dashboard.component';
import { AppUserComponent } from './component/user/app-user/app-user.component';
import { CommentComponent } from './component/user/comment/comment.component';
import { ListOrderComponent } from './component/user/list-order/list-order.component';
import { LogoutComponent } from './component/user/logout/logout.component';
import { RegisterComponent } from './component/register/register.component';
import { RepasMapComponent } from './component/search/repas-map/repas-map.component';


const routes: Routes = [
  { path: 'home', component: HomeComponent },
  { path: 'restaurant/:id', component: RestaurantProfileComponent },
  { path: 'search/restaurant', component: RestaurantComponent },
  { path: 'search/map/repas', component: RepasMapComponent },
  { path: 'search/repas', component: SearchComponent },
  { path: 'contact', component: ContactComponent },
  { path: 'register', component: RegisterComponent  },
  // Auth


  {
    path: 'user',
    component: AppUserComponent,
    canActivate: [AuthGuard],
    children: [
      {path: 'dashboard', component: DashboardComponent},
      {path: 'edit', component: EditComponent},
      {path: 'comment', component: CommentComponent},
      {path: 'order-list', component: ListOrderComponent},
      {path: 'logout', component: LogoutComponent},
    ]
  },
  { path: 'checkout', component: CheckoutComponent, canActivate: [AuthGuard]},

  // All
  { path: '**', redirectTo: 'home', pathMatch: 'full' },


];

@NgModule({
  imports: [RouterModule.forRoot(routes, {
    scrollPositionRestoration: 'top'
    })],
  exports: [RouterModule]
})
export class AppRoutingModule { }
