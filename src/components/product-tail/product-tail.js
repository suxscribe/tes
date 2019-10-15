import Component from '../../common/js/component';
import { getDeviceType, isIE, nFindComponent, nFindComponents } from '../../common/js/helpers';
import ProductSection1 from '../product-section-1/product-section-1';
import Advantages from '../advantages/advantages';
import Gallery from '../gallery/gallery';
import Projects from '../projects/projects';
import NamingStructure from '../naming-structure/naming-structure';
import Documents from '../documents/documents';
import Feedback from '../feedback/feedback';
import AppliedPerformances from '../applied-performances/applied-performances';
import SolutionImage from '../solution-image/solution-image';
import Header from '../header/header';
import Construct from '../construct/construct';
import Specifications from '../specifications/specifications';
import ProductHead from '../product-head/product-head';
import Competence from '../competence/competence';
import CompetenceMobile from '../competence-mobile/competence-mobile';

class ProductTail extends Component {
  constructor(nRoot) {
    super(nRoot, 'product-tail');
    if (nFindComponent('product-section-1', this.nRoot)) {
      this.productSection1 = new ProductSection1(nFindComponent('product-section-1'), this.nRoot);
    } else if (nFindComponent('solution-image', this.nRoot)) {
      this.productSection1 = new SolutionImage(nFindComponent('solution-image'), this.nRoot);
    }
    this.firstSection = this.productSection1;
    if (nFindComponent('construct', this.nRoot)) {
      this.construct = new Construct(nFindComponent('construct', this.nRoot));
    }
    if (nFindComponent('documents', this.nRoot)) {
      this.documents = new Documents(nFindComponent('documents', this.nRoot));
    }
    if (nFindComponent('advantages', this.nRoot)) {
      this.advantages = new Advantages(nFindComponent('advantages', this.nRoot));
    }
    this.specifications = nFindComponents('specifications', this.nRoot)
      .map(nSpecifications => new Specifications(nSpecifications));
    if (nFindComponent('gallery', this.nRoot)) {
      this.gallery = new Gallery(nFindComponent('gallery', this.nRoot));
    }
    if (nFindComponent('projects', this.nRoot)) {
      this.projects = new Projects(nFindComponent('projects', this.nRoot));
    }
    if (nFindComponent('naming-structure', this.nRoot)) {
      this.naming = new NamingStructure(nFindComponent('naming-structure', this.nRoot));
    }
    if (nFindComponent('applied-performances', this.nRoot)) {
      this.appliedPerformances = new AppliedPerformances(nFindComponent('applied-performances'), this.nRoot);
    }
    if (nFindComponents('competence', this.nRoot).length > 0) {
      this.competences = nFindComponents('competence', this.nRoot)
        .map(nCompetence => new Competence(nCompetence));
    }
    if (nFindComponents('competence-mobile', this.nRoot).length > 0) {
      this.competencesMobile = nFindComponents('competence-mobile', this.nRoot)
        .map(nCompetenceMobile => new CompetenceMobile(nCompetenceMobile));
    }
    this.feedback = new Feedback(nFindComponent('feedback', this.nRoot));
    this.header = new Header(nFindComponent('header', this.nRoot));
  }

  destroy() {
    this.header.destroy();
    if (this.competences) {
      this.competences.forEach(competence => competence.destroy());
    }
    if (this.competencesMobile) {
      this.competencesMobile.forEach(competenceMobile => competenceMobile.destroy());
    }
    if (this.productSection1) {
      this.productSection1.destroy();
    }
    if (this.construct) {
      this.construct.destroy();
    }
    if (this.documents) {
      this.documents.destroy();
    }
    if (this.advantages) {
      this.advantages.destroy();
    }
    this.specifications.forEach(specifications => specifications.destroy());
    if (this.gallery) {
      this.gallery.destroy();
    }
    if (this.projects) {
      this.projects.destroy();
    }
    if (this.naming) {
      this.naming.destroy();
    }
    if (this.appliedPerformances) {
      this.appliedPerformances.destroy();
    }
    this.feedback.destroy();
  }
}

export default ProductTail;
