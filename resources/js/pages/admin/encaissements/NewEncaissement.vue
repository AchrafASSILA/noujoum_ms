<template>
    <MainLayout>
        <div v-if="loaded">
            <h4 class="mb-5 mb-sm-0 fw-bold">
                Nouveau paiement <span>{{ clientSearch?.name }}</span>
            </h4>

            <div
                class="card mb-25 border-0 rounded-0 bg-white letter-spacing mt-4"
            >
                <div
                    class="col-12 card-head box-shadow bg-white d-lg-flex align-items-center justify-content-between p-15 p-sm-20 p-md-25"
                >
                    <div class="col-9"></div>
                    <div class="col-3">
                        <VueMultiselect
                            v-model="clientSearch"
                            :options="clients"
                            :multiple="false"
                            :close-on-select="true"
                            placeholder="Choisissez un client"
                            label="name"
                            value="id"
                            track-by="id"
                            @select="getClientEncaissements()"
                        >
                        </VueMultiselect>
                    </div>
                </div>
            </div>

            <div class="row" v-if="clientLoaded">
                <div v-if="inscription && inscription.client" class="row">
                    <div class="col-lg-5 col-xl-4">
                        <div
                            class="card mb-25 border-0 rounded-0 bg-white letter-spacing lead-info-box"
                        >
                            <div class="card-body p-15 p-sm-20 p-md-25 p-lg-30">
                                <div
                                    class="profile-info d-sm-flex align-items-center"
                                >
                                    <img
                                        :src="inscription.client.image"
                                        class="rounded"
                                        alt="user"
                                    />
                                    <div class="title mt-12 mt-sm-0">
                                        <h5 class="text-black fw-medium mb-8">
                                            {{ inscription.client.name }}
                                        </h5>
                                    </div>
                                </div>
                                <div
                                    class="border-top mt-15 mb-15 mt-sm-20 mb-sm-20 mt-md-25 mb-md-25 mt-lg-30 mb-lg-30"
                                ></div>
                                <div
                                    class="d-flex align-items-center justify-content-between"
                                >
                                    <h5
                                        class="fw-medium text-black-emphasis mb-0"
                                    >
                                        Information global
                                    </h5>
                                </div>
                                <ul class="info mt-25 ps-0 mb-0 list-unstyled">
                                    <li class="position-relative">
                                        <div
                                            class="icon text-success rounded-circle text-center"
                                        >
                                            <i
                                                class="flaticon-mail-inbox-app"
                                            ></i>
                                        </div>
                                        <span
                                            class="d-block text-black mb-5 fw-semibold"
                                            >Email</span
                                        >
                                        <a
                                            href="mailto:johnathon23@gmail.com"
                                            class="d-inline-block fs-md-15 fs-lg-16 text-primary text-decoration-none"
                                        >
                                            {{ inscription.client.email }}
                                        </a>
                                    </li>
                                    <li class="position-relative">
                                        <div
                                            class="icon text-info rounded-circle text-center"
                                        >
                                            <i
                                                class="flaticon-telephone-call"
                                            ></i>
                                        </div>
                                        <span
                                            class="d-block text-black mb-5 fw-semibold"
                                            >Phone No</span
                                        >
                                        <a
                                            href="tel:+1-321-456-8756"
                                            class="d-inline-block fs-md-15 fs-lg-16 text-muted text-decoration-none"
                                        >
                                            {{ inscription.client.tel }}
                                        </a>
                                    </li>

                                    <li class="position-relative">
                                        <div
                                            class="icon text-success rounded-circle text-center"
                                        >
                                            <i class="flaticon-money"></i>
                                        </div>
                                        <span
                                            class="d-block text-black mb-5 fw-semibold"
                                        >
                                            Total payement
                                        </span>
                                        <span
                                            class="d-inline-block fs-md-15 fs-lg-16 text-muted"
                                        >
                                            {{ inscription.payed }}
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-xl-8">
                        <div class="leads-details-tabs">
                            <ul
                                class="nav nav-tabs border-0 mb-25"
                                id="myTab"
                                role="tablist"
                            >
                                <li class="nav-item" role="presentation">
                                    <button
                                        class="nav-link fs-md-15 fs-lg-16 fw-medium border-0 rounded-0 d-block text-center w-100 active"
                                        id="deals-tab"
                                        data-bs-toggle="tab"
                                        data-bs-target="#deals-tab-pane"
                                        type="button"
                                        role="tab"
                                        aria-controls="deals-tab-pane"
                                        aria-selected="false"
                                    >
                                        Tarifs
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button
                                        class="nav-link fs-md-15 fs-lg-16 fw-medium border-0 rounded-0 d-block text-center w-100"
                                        id="emails-tab"
                                        data-bs-toggle="tab"
                                        data-bs-target="#emails-tab-pane"
                                        type="button"
                                        role="tab"
                                        aria-controls="emails-tab-pane"
                                        aria-selected="false"
                                    >
                                        Encaissements historique
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div
                                    class="tab-pane fade show active"
                                    id="deals-tab-pane"
                                    role="tabpanel"
                                    tabindex="0"
                                >
                                    <div
                                        class="card mb-25 border-0 rounded-0 bg-white letter-spacing"
                                    >
                                        <div
                                            class="card-head bg-white d-md-flex align-items-center justify-content-between pt-15 pb-15 ps-15 pe-15 ps-sm-20 pe-sm-20 ps-md-25 pe-md-25 ps-lg-30 pe-lg-30"
                                        >
                                            <div
                                                class="d-sm-flex align-items-center"
                                            >
                                                <button
                                                    class="default-btn position-relative transition border-0 fw-medium text-white pt-11 pb-11 ps-25 pe-25 pt-md-12 pb-md-12 ps-md-30 pe-md-30 rounded-1 bg-success fs-md-15 fs-lg-16 d-inline-block me-10 mb-10 mb-lg-0 text-decoration-none"
                                                    style="
                                                        background-color: #06b48a !important;
                                                    "
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#basicModal"
                                                >
                                                    Nouveau service
                                                    <i
                                                        class="flaticon-plus position-relative ms-5 fs-12"
                                                    ></i>
                                                </button>
                                            </div>
                                            <div
                                                class="d-flex align-items-center"
                                            >
                                                <form
                                                    class="search-box position-relative me-15"
                                                    @submit.prevent=""
                                                >
                                                    <input
                                                        type="text"
                                                        v-model="search"
                                                        class="form-control shadow-none text-black rounded-0 border-0"
                                                        placeholder="Rechercher"
                                                    />
                                                    <button
                                                        type="submit"
                                                        class="bg-transparent text-primary transition p-0 border-0"
                                                    >
                                                        <i
                                                            class="flaticon-search-interface-symbol"
                                                        ></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        <div
                                            class="card-body pt-0 pb-15 pb-sm-20 pb-md-25 pb-lg-30 ps-15 pe-15 ps-sm-20 pe-sm-20 ps-md-25 pe-md-25 ps-lg-30 pe-lg-30"
                                        >
                                            <div class="table-responsive">
                                                <v-data-table
                                                    :headers="headers"
                                                    :items="
                                                        inscription.affectations
                                                    "
                                                    item-value="name"
                                                    :search="search"
                                                >
                                                    <template
                                                        v-slot:item="{ item }"
                                                    >
                                                        <tr>
                                                            <th
                                                                class="shadow-none lh-1 fw-medium text-black-emphasis title ps-0"
                                                            >
                                                                <div
                                                                    class="form-check d-flex align-items-center mb-0 justify-content-center p-0"
                                                                >
                                                                    <!-- <input
                                                                        class="form-check-input shadow-none me-8 mt-0"
                                                                        type="checkbox"
                                                                    /> -->
                                                                    {{
                                                                        item.service_label
                                                                    }}
                                                                </div>
                                                            </th>
                                                            <th
                                                                class="shadow-none lh-1 fw-medium text-black-emphasis title ps-0"
                                                            >
                                                                <div
                                                                    class="form-check d-flex align-items-center mb-0 justify-content-center p-0"
                                                                >
                                                                    {{
                                                                        item.service_frequenc
                                                                    }}
                                                                </div>
                                                            </th>
                                                            <th
                                                                class="shadow-none lh-1 fw-medium text-black-emphasis title ps-0"
                                                            >
                                                                <div
                                                                    class="form-check d-flex align-items-center mb-0 text-center justify-content-center p-0"
                                                                >
                                                                    {{
                                                                        item.service_periode
                                                                    }}
                                                                </div>
                                                            </th>
                                                            <td
                                                                class="shadow-none lh-1 fw-medium text-black-emphasis justify-content-center p-0"
                                                            >
                                                                <div
                                                                    class="form-check d-flex align-items-center mb-0 text-center justify-content-center p-0"
                                                                >
                                                                    {{
                                                                        item.amount
                                                                    }}
                                                                </div>
                                                            </td>
                                                            <td
                                                                class="shadow-none lh-1 fw-medium text-black-emphasis justify-content-center p-0"
                                                            >
                                                                <div
                                                                    class="form-check d-flex align-items-center mb-0 text-center justify-content-center p-0"
                                                                >
                                                                    {{
                                                                        item.payed
                                                                    }}
                                                                </div>
                                                            </td>
                                                            <td
                                                                class="shadow-none lh-1 fw-medium text-black-emphasis justify-content-center p-0"
                                                            >
                                                                <div
                                                                    class="form-check d-flex align-items-center mb-0 text-center justify-content-center p-0"
                                                                >
                                                                    {{
                                                                        item.reste
                                                                    }}
                                                                </div>
                                                            </td>

                                                            <td
                                                                class="shadow-none lh-1 fw-medium text-body-tertiary text-end pe-0"
                                                            >
                                                                <div
                                                                    class="dropdown"
                                                                >
                                                                    <button
                                                                        class="dropdown-toggle lh-1 bg-transparent border-0 shadow-none p-0 transition"
                                                                        type="button"
                                                                        data-bs-toggle="dropdown"
                                                                        aria-expanded="false"
                                                                    >
                                                                        <i
                                                                            class="flaticon-dots"
                                                                        ></i>
                                                                    </button>
                                                                    <ul
                                                                        class="dropdown-menu"
                                                                    >
                                                                        <li
                                                                            v-if="
                                                                                item.payedAmount !=
                                                                                item.restePrice
                                                                            "
                                                                        >
                                                                            <button
                                                                                class="dropdown-item d-flex align-items-center"
                                                                                @click.prevent="
                                                                                    setPay(
                                                                                        item
                                                                                    )
                                                                                "
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#basicModals"
                                                                            >
                                                                                <!-- @click="
                                                                                    makePayement(
                                                                                        item
                                                                                    )
                                                                                " -->
                                                                                <i
                                                                                    class="flaticon-view lh-1 me-8 position-relative top-1"
                                                                                ></i>
                                                                                Paye
                                                                            </button>
                                                                        </li>
                                                                        <!-- <li>
                                                                            <a
                                                                                class="dropdown-item d-flex align-items-center"
                                                                                href="javascript:void(0);"
                                                                                ><i
                                                                                    class="flaticon-pen lh-1 me-8 position-relative top-1"
                                                                                ></i>
                                                                                Edit</a
                                                                            >
                                                                        </li> -->
                                                                        <li
                                                                            v-if="
                                                                                item.payedAmount ==
                                                                                0
                                                                            "
                                                                        >
                                                                            <button
                                                                                class="dropdown-item d-flex align-items-center"
                                                                                @click.prevent="
                                                                                    deleteAffectation(
                                                                                        item
                                                                                    )
                                                                                "
                                                                            >
                                                                                <i
                                                                                    class="flaticon-delete lh-1 me-8 position-relative top-1"
                                                                                ></i>
                                                                                disafectée
                                                                            </button>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </template></v-data-table
                                                >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="tab-pane fade"
                                    id="emails-tab-pane"
                                    role="tabpanel"
                                    tabindex="0"
                                >
                                    <div
                                        class="card mb-25 border-0 rounded-0 bg-white letter-spacing"
                                    >
                                        <div
                                            class="card-head bg-white d-md-flex align-items-center justify-content-between pt-15 pb-15 ps-15 pe-15 ps-sm-20 pe-sm-20 ps-md-25 pe-md-25 ps-lg-30 pe-lg-30"
                                        >
                                            <h5 class="card-title fw-bold mb-0">
                                                Encaissements
                                            </h5>
                                        </div>
                                        <div
                                            class="card-body pt-0 pb-15 pb-sm-20 pb-md-25 pb-lg-30 ps-15 pe-15 ps-sm-20 pe-sm-20 ps-md-25 pe-md-25 ps-lg-30 pe-lg-30"
                                        >
                                            <div class="table-responsive">
                                                <table
                                                    class="table text-nowrap align-middle mb-0"
                                                >
                                                    <thead>
                                                        <tr>
                                                            <th
                                                                scope="col"
                                                                class="text-uppercase fw-medium shadow-none text-body-tertiary fs-13 pt-0 ps-0"
                                                            >
                                                                Montant
                                                            </th>
                                                            <th
                                                                scope="col"
                                                                class="text-uppercase fw-medium shadow-none text-body-tertiary fs-13 pt-0"
                                                            >
                                                                Numero du recu
                                                            </th>
                                                            <th
                                                                scope="col"
                                                                class="text-uppercase fw-medium shadow-none text-body-tertiary fs-13 pt-0"
                                                            >
                                                                Mode de paiement
                                                            </th>
                                                            <th
                                                                scope="col"
                                                                class="text-uppercase fw-medium shadow-none text-body-tertiary fs-13 pt-0"
                                                            >
                                                                Date de paiement
                                                            </th>
                                                            <th
                                                                scope="col"
                                                                class="text-uppercase fw-medium shadow-none text-body-tertiary fs-13 pt-0"
                                                            >
                                                                Canceled
                                                            </th>
                                                            <th
                                                                scope="col"
                                                                class="text-uppercase fw-medium shadow-none text-body-tertiary fs-13 pt-0 text-end pe-0"
                                                            ></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr
                                                            v-for="(
                                                                item, index
                                                            ) in inscription.encaissements"
                                                            :key="index"
                                                        >
                                                            <th
                                                                class="shadow-none lh-1 fw-medium text-black-emphasis title fs-md-15 fs-lg-16 ps-0"
                                                            >
                                                                {{ item.total }}
                                                            </th>
                                                            <td
                                                                class="shadow-none lh-1 fw-medium text-black-emphasis text-center"
                                                            >
                                                                {{
                                                                    item.recuNumber
                                                                }}
                                                            </td>
                                                            <td
                                                                class="shadow-none lh-1 fw-medium text-center"
                                                            >
                                                                <!-- <span
                                                                    class="badge text-outline-success"
                                                                    ></span
                                                                > -->
                                                                {{ item.mode }}
                                                            </td>
                                                            <td
                                                                class="shadow-none lh-1 fw-medium text-black-emphasis text-center"
                                                            >
                                                                {{ item.date }}
                                                            </td>
                                                            <td
                                                                class="shadow-none lh-1 fw-medium text-black-emphasis text-center"
                                                            >
                                                                {{
                                                                    item.canceled
                                                                        ? item.canceled
                                                                        : "non"
                                                                }}
                                                            </td>
                                                            <td
                                                                class="shadow-none lh-1 fw-medium text-body-tertiary text-end pe-0"
                                                            >
                                                                <div
                                                                    class="dropdown"
                                                                >
                                                                    <button
                                                                        class="dropdown-toggle lh-1 bg-transparent border-0 shadow-none p-0 transition"
                                                                        type="button"
                                                                        data-bs-toggle="dropdown"
                                                                        aria-expanded="false"
                                                                    >
                                                                        <i
                                                                            class="flaticon-dots"
                                                                        ></i>
                                                                    </button>
                                                                    <ul
                                                                        class="dropdown-menu"
                                                                    >
                                                                        <!-- <li>
                                                                            <a
                                                                                class="dropdown-item d-flex align-items-center"
                                                                                href="javascript:void(0);"
                                                                                ><i
                                                                                    class="flaticon-view lh-1 me-8 position-relative top-1"
                                                                                ></i>
                                                                                View</a
                                                                            >
                                                                        </li> -->
                                                                        <li>
                                                                            <button
                                                                                v-if="
                                                                                    !item.canceled
                                                                                "
                                                                                target="_blank"
                                                                                @click="
                                                                                    cancelPaiement(
                                                                                        item
                                                                                    )
                                                                                "
                                                                                class="dropdown-item d-flex align-items-center"
                                                                            >
                                                                                <i
                                                                                    class="flaticon-close lh-1 me-8 position-relative top-1"
                                                                                ></i>
                                                                                cancel
                                                                                paiement
                                                                            </button>
                                                                            <a
                                                                                target="_blank"
                                                                                :href="
                                                                                    '/impressions-encaissement-recu/' +
                                                                                    item.id
                                                                                "
                                                                                class="dropdown-item d-flex align-items-center"
                                                                            >
                                                                                <i
                                                                                    class="flaticon-printing lh-1 me-8 position-relative top-1"
                                                                                ></i>
                                                                                imprimer
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->

                    <div
                        class="modal fade"
                        id="basicModal"
                        tabindex="-1"
                        aria-hidden="true"
                    >
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1
                                        class="modal-title fs-5"
                                        id="addNiveauLabel"
                                    >
                                        Ajouter un tarif
                                    </h1>
                                    <button
                                        type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal"
                                        aria-label="Close"
                                    ></button>
                                </div>

                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-mb-15 mb-md-20">
                                                <label
                                                    for="inputTitle"
                                                    class="form-label fw-medium"
                                                    >Service</label
                                                >

                                                <VueMultiselect
                                                    v-model="
                                                        affectation.service
                                                    "
                                                    :options="services"
                                                    :multiple="false"
                                                    :close-on-select="true"
                                                    placeholder="Choisissez une service"
                                                    label="label"
                                                    value="id"
                                                    track-by="id"
                                                    @select="setPrice()"
                                                >
                                                </VueMultiselect>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-mb-15 mb-md-20">
                                                <label
                                                    for="inputTitle"
                                                    class="form-label fw-medium"
                                                    >Reduction</label
                                                >
                                                <VueMultiselect
                                                    v-model="
                                                        affectation.reduction
                                                    "
                                                    :options="reductions"
                                                    :multiple="false"
                                                    :close-on-select="true"
                                                    placeholder="Choisissez une service"
                                                    label="label"
                                                    value="id"
                                                    track-by="id"
                                                    @select="setPrice()"
                                                    @remove="removeReduction()"
                                                >
                                                </VueMultiselect>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="row"
                                        v-if="
                                            affectation.service &&
                                            affectation.service.frequenc &&
                                            affectation.service.frequenc ==
                                                'GroupementEntreprise'
                                        "
                                    >
                                        <div class="col">
                                            <div class="mb-mb-15 mb-md-20">
                                                <label
                                                    for="inputTitle"
                                                    class="form-label fw-medium"
                                                    >Personnes</label
                                                >
                                                <input
                                                    type="number"
                                                    class="form-control shadow-none text-black fs-md-15 fs-lg-16"
                                                    @input="setPrice()"
                                                    v-model="personneNumber"
                                                />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div
                                                class="mb-mb-15 mb-md-20 d-flex flex-column justify-centent-end align-items-end"
                                            >
                                                <label
                                                    for="inputTitle"
                                                    class="form-label fw-bold"
                                                    >Service fréquence</label
                                                >
                                                <span
                                                    class="form-label fw-medium"
                                                    >{{
                                                        affectation.service
                                                            ?.frequenc
                                                    }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div
                                                class="mb-mb-15 mb-md-20 d-flex flex-column justify-centent-end align-items-end"
                                            >
                                                <label
                                                    for="inputTitle"
                                                    class="form-label fw-bold"
                                                    >Service prix</label
                                                >
                                                <span
                                                    class="form-label fw-medium"
                                                    >{{
                                                        affectation.price
                                                    }}
                                                    DH</span
                                                >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-mb-15 mb-md-20">
                                            <label
                                                for="inputTitle"
                                                class="form-label fw-medium"
                                                >Module</label
                                            >
                                            <VueMultiselect
                                                v-model="affectation.module"
                                                :options="modules"
                                                :multiple="false"
                                                :close-on-select="true"
                                                placeholder="Choisissez un module"
                                                label="label"
                                                value="id"
                                                track-by="id"
                                            >
                                            </VueMultiselect>
                                        </div>
                                    </div>

                                    <div class="col" v-if="false">
                                        <div class="mb-mb-15 mb-md-20">
                                            <label
                                                for="inputTitle"
                                                class="form-label fw-medium"
                                                >Periode</label
                                            >
                                            <VueMultiselect
                                                v-if="
                                                    affectation.service
                                                        .frequenc == 'Mensuel'
                                                "
                                                v-model="affectation.periodes"
                                                :options="months"
                                                :close-on-select="true"
                                                placeholder="Choisissez periodes"
                                            >
                                            </VueMultiselect>
                                            <VueMultiselect
                                                v-if="
                                                    affectation.service
                                                        .frequenc ==
                                                    'trimestriel'
                                                "
                                                v-model="affectation.periodes"
                                                :options="trimestres"
                                                :close-on-select="true"
                                                placeholder="Choisissez periodes"
                                            >
                                            </VueMultiselect>
                                        </div>
                                    </div>

                                    <Errors></Errors>
                                </div>

                                <div class="modal-footer">
                                    <button
                                        type="button"
                                        class="btn btn-secondary"
                                        data-bs-dismiss="modal"
                                        ref="closeBtn"
                                    >
                                        Fermer
                                    </button>

                                    <button
                                        type="button"
                                        @click="saveAffectation()"
                                        class="btn btn-primary"
                                    >
                                        Enregistrer
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="modal fade"
                        id="basicModals"
                        tabindex="-1"
                        aria-hidden="true"
                    >
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 v-if="isEdit" class="modal-title fs-5">
                                        Éditer {{ module.label }}
                                    </h1>
                                    <h1
                                        v-else
                                        class="modal-title fs-5"
                                        id="addNiveauLabel"
                                    >
                                        Nouveau paiement
                                    </h1>
                                    <button
                                        type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal"
                                        aria-label="Close"
                                    ></button>
                                </div>

                                <div class="modal-body">
                                    <div class="mb-mb-15 mb-md-20">
                                        <label class="form-label fw-medium"
                                            >montant pour payer</label
                                        >
                                        <input
                                            v-model="currentPay.price"
                                            type="number"
                                            :max="payement.restePrice"
                                            class="form-control shadow-none text-black fs-md-15 fs-lg-16"
                                            id="inputTitle"
                                            aria-describedby="TitleHelp"
                                            placeholder="Enter title"
                                        />
                                    </div>

                                    <Errors></Errors>
                                </div>

                                <div class="modal-footer">
                                    <button
                                        type="button"
                                        class="btn btn-secondary"
                                        data-bs-dismiss="modal"
                                        ref="closeBtns"
                                    >
                                        Fremer
                                    </button>

                                    <button
                                        type="button"
                                        @click="makePayement(payement)"
                                        class="btn btn-primary"
                                    >
                                        Enregistrer
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-else>
                    <div class="card">
                        <Emptybox> </Emptybox>
                        <p
                            class="text-center font-bold"
                            style="font-weight: bold"
                        >
                            Merci de sélectionner un client
                        </p>
                    </div>
                </div>
            </div>
            <Loader v-else></Loader>
        </div>
        <Loader v-else></Loader>
    </MainLayout>
</template>
<style src="vue-multiselect/dist/vue-multiselect.css"></style>
<script lang="ts" setup>
import { ref, onMounted } from "vue";
import MainLayout from "../../../layouts/MainLayout.vue";
import Swal from "sweetalert2";
import Emptybox from "../../../Components/ui/EmptyBox.vue";
import Errors from "../../../Components/ui/Errors.vue";
import Loader from "../../../Components/ui/Loader.vue";
import { useErrorStore } from "../../../store/error";

import VueMultiselect from "vue-multiselect";
import { useEncaissementStore } from "../../../store/encaissement";
import { useClientStore } from "../../../store/client";
import { useServiceStore } from "../../../store/service";
import { useModuleStore } from "../../../store/module";

// lifecycle
onMounted(async () => {
    await getClients();
    await getServices();
    await getReductions();
    await getModules();
    loaded.value = true;
});

// vars
let search = ref("");
let services = ref([]);
let headers = ref([
    {
        align: "center",
        key: "service_label",
        sortable: true,
        title: "Service",
    },
    {
        align: "center",
        key: "service_frequenc",
        sortable: true,
        title: "Type",
    },
    {
        align: "center",
        key: "service_periode",
        sortable: true,
        title: "Periode",
    },
    {
        align: "center",
        key: "amount",
        sortable: true,
        title: "Montant",
    },
    {
        align: "center",
        key: "payed",
        sortable: true,
        title: "Paye",
    },
    {
        align: "center",
        key: "reste",
        sortable: true,
        title: "Reste",
    },
    { align: "end", key: "actions", title: "Actions" },
]);
let closeBtn = ref("");
let closeBtns = ref("");
let clients = ref([]);
let reductions = ref([]);
let modules = ref([]);
let inscription = ref(null);
let clientSearch = ref(null);
let errors = ref([]);
let personneNumber = ref(1);
let affectation = ref({
    service: null,
    price: "00.00",
    reduction: null,
    module: null,
    inscription: null,
});

let loaded = ref(false);
let payement = ref({});
let currentPay = ref({
    price: 0,
});
let clientLoaded = ref(true);

// stores
const encaissementStore = useEncaissementStore();
const clientStore = useClientStore();
const errorStore = useErrorStore();
const serviceStore = useServiceStore();
const moduleStore = useModuleStore();

// functions
let getClients = async () => {
    await clientStore
        .getClients()
        .then((res) => {
            clients.value = clientStore.clients;
        })
        .catch((err) => {
            errorStore.errors = [];
            errorStore.errors.push(err.response.data.msg);
        });
};
let setPrice = () => {
    if (!affectation.value.service) {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "merci de choisir une service",
        });

        return;
    }

    if (affectation.value.reduction) {
        affectation.value.price =
            affectation.value.service.price -
            (affectation.value.reduction.value *
                affectation.value.service.price) /
                100;
    } else {
        affectation.value.price = affectation.value.service.price;
    }
    if (affectation.value.service.frequenc == "GroupementEntreprise") {
        affectation.value.price =
            affectation.value.price * personneNumber.value;
    }
};
let removeReduction = () => {
    affectation.value.price = affectation.value.service.price;
};
let getServices = async () => {
    await serviceStore
        .getSections()
        .then((res) => {
            services.value = serviceStore.services;
        })
        .catch((err) => {
            errorStore.errors = [];
            errorStore.errors.push(err.response.data.msg);
        });
};
let getModules = async () => {
    await moduleStore
        .getModules()
        .then((res) => {
            modules.value = moduleStore.modules;
        })
        .catch((err) => {
            errorStore.errors = [];
            errorStore.errors.push(err.response.data.msg);
        });
};
let getReductions = async () => {
    await serviceStore
        .getReductions()
        .then((res) => {
            reductions.value = serviceStore.reductions;
        })
        .catch((err) => {
            errorStore.errors = [];
            errorStore.errors.push(err.response?.data?.msg);
        });
};
let getClientEncaissements = async () => {
    clientLoaded.value = false;
    await encaissementStore
        .getClientEncaissements(clientSearch.value.id)
        .then((res) => {
            inscription.value = encaissementStore.inscription;
            errorStore.errors = [];
        })
        .catch((err) => {
            errorStore.errors = [];
            errorStore.errors.push(err.response.data.msg);
        })
        .finally(() => {
            clientLoaded.value = true;
        });
};
let saveAffectation = async () => {
    affectation.value.inscription = inscription.value.id;
    await encaissementStore
        .saveAffectation(affectation.value)
        .then(() => {
            Swal.fire("Succès", "Succès");
            closeBtn.value.click();
            getClientEncaissements();
            inisialize();
            errorStore.errors = [];
        })
        .catch((err) => {
            errorStore.errors = [];
            errorStore.errors.push(err.response.data.msg);
        });
};
let deleteAffectation = async (sec: any) => {
    console.log(sec);
    await Swal.fire({
        title: "Voulez-vous disafectée ce tarif?",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: "Yes",
    }).then((result) => {
        if (result.isConfirmed) {
            encaissementStore
                .deleteAffectation(sec.id)
                .then(() => {
                    Swal.fire("Succès", "tarif disafectée avec succès");
                    getClientEncaissements();
                })
                .catch((err) => {
                    console.log(err);
                });
        }
    });
};
let cancelPaiement = async (item: any) => {
    await Swal.fire({
        title: "Voulez-vous cancel ce paiement?",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: "Yes",
    }).then((result) => {
        if (result.isConfirmed) {
            encaissementStore
                .cancelPaiement(item.id)
                .then(() => {
                    Swal.fire("Succès", "Succès");
                    getClientEncaissements();
                })
                .catch((err) => {
                    console.log(err);
                });
        }
    });
};

let makePayement = async (pay: any) => {
    await Swal.fire({
        title: "Voulez-vous payé ce tarif ?",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: "Yes",
    }).then((result) => {
        if (result.isConfirmed) {
            encaissementStore
                .makePayement(pay, inscription.value.id, currentPay.value.price)
                .then((res) => {
                    closeBtns.value.click();
                    Swal.fire("Succès", "payement avec succès");
                    getClientEncaissements();
                    window.open(
                        "/noujoum/impressions-encaissement-recu/" +
                            encaissementStore.lastEncaissement
                    );
                })
                .catch((err) => {
                    console.log(err);
                });
        }
    });
};
let inisialize = () => {
    affectation.value = {
        service: null,
        price: "00.00",
        reduction: null,
        inscription: null,
    };
    personneNumber.value = 1;
    errorStore.errors = [];
};
let setPay = (mod) => {
    payement.value = mod;
};
</script>
