import request from '@/utils/request';
import Resource from '@/api/resource';

class VehicleListingResource extends Resource {
  constructor() {
    super('vehiclelisting');
  }
  vlcd(){
    return request({
      url: '/' + this.uri + '/vlcd',
      method: 'get',
    });
  }
  userlistingsdetail(id) {
    return request({
      url: '/' + this.uri + '/userlistingsdetail/' + id,
      method: 'get',
    });
  }
  userlistings(query)
  {
    return request({
      url: '/' + this.uri + '/userlistings',
      method: 'get',
      params: query,
    });
  }
  vatovlimagecopy(data){
    return request({
      url: '/' + this.uri + '/vatovlimagecopy',
      method: 'post',
      data:data,
    });
  }
  rimagenew(data){
    return request({
      url: '/' + this.uri + '/rimagenew',
      method: 'post',
      data:data,
    });
  }

  	/**Added by Shraddha Gupta */
  featuredAuctions(){
    return request({
      url: '/featured-auctions',
      method: 'get',
    });
  }

  bidsEndingToday(){
    return request({
      url: '/bids-ending-today',
      method: 'get',
    });
  }

  newListing(){
    return request({
      url: '/new-listings',
      method: 'get',
    });
  }

  recentFeatures(){
    return request({
      url: '/recent-features',
      method: 'get',
    });
  }

  auctionDetails(id) {
    return request({
      url: '/auction-details/'+id,
      method: 'get',
    });
  }

  commentDetails(id) {
    return request({
      url: '/comment-details/'+id,
      method: 'get',
    });
  }
  /**Ended by Shraddha Gupta */
}
	

export { VehicleListingResource as default };
