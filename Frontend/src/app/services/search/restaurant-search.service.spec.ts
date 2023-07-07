import { TestBed } from '@angular/core/testing';

import { RestaurantSearchService } from './restaurant-search.service';

describe('RestaurantSearchService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: RestaurantSearchService = TestBed.get(RestaurantSearchService);
    expect(service).toBeTruthy();
  });
});
