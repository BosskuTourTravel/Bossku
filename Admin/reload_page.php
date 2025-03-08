<script>
    function logOut() {
        window.location = "https://www.holidaymyboss.com/member/";
    }

    function reloadManual(x, y, z) {

        $("#divDashboard").hide();

        $("#divReloadPage").show();
        document.getElementById("loading").style.display = "block";

        if (x == 0) {

            $.ajax({

                url: "officecost.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y,
                    tipe: z
                },

                success: function(data) {

                    $("#divReloadPage").html(data);


                }

            });

        } else if (x == 1) {
            $.ajax({

                url: "flight.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    $("#divReloadPage").html(data);

                }

            });
        } else if (x == 2) {
            $.ajax({

                url: "tourLeaderFee.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    $("#divReloadPage").html(data);

                }

            });
        } else if (x == 3) {
            $.ajax({

                url: "hotel.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    $("#divReloadPage").html(data);

                }

            });
        } else if (x == 4) {
            $.ajax({

                url: "flight_quotation.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    $("#divReloadPage").html(data);

                }

            });
        } else if (x == 5) {
            $.ajax({

                url: "admissionPrice.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    $("#divReloadPage").html(data);

                }

            });
        } else if (x == 6) {
            $.ajax({

                url: "admission.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    $("#divReloadPage").html(data);

                }

            });
        } else if (x == 7) {
            $.ajax({

                url: "itineraryFlight.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    $("#divReloadPage").html(data);

                }

            });
        } else if (x == 8) {
            $.ajax({

                url: "formUploadDrive.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    $("#divReloadPage").html(data);

                }

            });
        } else if (x == 9) {
            $.ajax({

                url: "new_landtour.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);

                }

            });
        } else if (x == 10) {
            $.ajax({

                url: "new_cruise.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);

                }

            });
        } else if (x == 11) {
            $.ajax({

                url: "cruise_ship_das.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);

                }

            });
        } else if (x == 12) {
            $.ajax({

                url: "cruise_order.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);

                }

            });
        } else if (x == 13) {
            $.ajax({

                url: "atraction_order.php",
                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);

                }

            });
        } else if (x == 14) {
            $.ajax({

                url: "export_excel.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);

                }

            });
        }
    }

    function editPage(x, y, z, c) {

        $("#divDashboard").hide();

        $("#divReloadPage").show();

        if (x == 0) {

            $.ajax({

                url: "formUpdatePricePackage.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y,
                    tid: z,
                    tourpricepackage: c
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == 1) {

            $.ajax({

                url: "formUpdateDetailPricePackage.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y,
                    tid: z,
                    tourpricepackage: c
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == 2) {

            $.ajax({

                url: "formUpdateItinerary.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y,
                    tid: z,
                    tourpricepackage: c
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == 3) {

            $.ajax({

                url: "formUpdateTourPackage.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y,
                    tid: z,
                    tourpricepackage: c
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == 4) {

            $.ajax({

                url: "formUpdateDate.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y,
                    tid: z,
                    tourpricepackage: c
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == -1) {

            $.ajax({

                url: "formUpdatePerformaPrice.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y,
                    tid: z,
                    tourpricepackage: c
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == -2) {

            $.ajax({

                url: "formUpdateInclusion.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y,
                    tid: z,
                    tourpricepackage: c
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == -3) {

            $.ajax({

                url: "formUpdateExclusion.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y,
                    tid: z,
                    tourpricepackage: c
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == -4) {

            $.ajax({

                url: "formUpdateRemarks.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y,
                    tid: z,
                    tourpricepackage: c
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == -5) {

            $.ajax({

                url: "formUpdateTerms.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y,
                    tid: z,
                    tourpricepackage: c
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == -6) {

            $.ajax({

                url: "formUpdateCountry.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y,
                    tid: z,
                    tourpricepackage: c
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == -7) {

            $.ajax({

                url: "formUpdateCity.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y,
                    tid: z,
                    tourpricepackage: c
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == -8) {

            $.ajax({

                url: "formUpdateAgentFiles.php",

                method: "POST",

                asynch: false,

                data: {
                    'id': y,
                    'tid': z,
                    'tourpricepackage': c
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == -9) {

            $.ajax({

                url: "formUpdatePerformaPriceAgent.php",

                method: "POST",

                asynch: false,

                data: {
                    'id': y,
                    'agent': z,
                    'country': c
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == -10) {

            $.ajax({

                url: "formUpdateAll.php",

                method: "POST",

                asynch: false,

                data: {
                    'id': y,
                    'tid': z,
                    'tourpricepackage': c
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == -11) {

            $.ajax({

                url: "formUpdateAgent.php",

                method: "POST",

                asynch: false,

                data: {
                    'id': y,
                    'tid': z,
                    'tourpricepackage': c
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });



        } else if (x == -12) {

            $.ajax({

                url: "formUpdateStaffCountry.php",

                method: "POST",

                asynch: false,

                data: {
                    'id': y,
                    'tid': z,
                    'tourpricepackage': c
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        }

    }

    function insertPage(x, y, z) {

        $("#divDashboard").hide();

        $("#divReloadPage").show();

        if (x == 0) {

            $.ajax({

                url: "formInsertPricePackage.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);;

                }

            });

        } else if (x == 1) {

            $.ajax({

                url: "formInsertDetailPricePackage.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y,
                    tourpricepackage: z
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == 2) {

            $.ajax({

                url: "formInsertItinerary.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == 3) {

            $.ajax({

                url: "formInsertTourPackage.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y,
                    id2: z
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == 4) {

            $.ajax({

                url: "formInsertDate.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == 5) {

            $.ajax({

                url: "formInsertPerformaPrice.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == 6) {

            $.ajax({

                url: "formInsertStaff.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == 7) {

            $.ajax({

                url: "formInsertCountry.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == 8) {

            $.ajax({

                url: "formInsertCity.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == 9) {

            $.ajax({

                url: "formInsertAll.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == 10) {

            $.ajax({

                url: "formInsertMultiplePackage.php",

                method: "POST",
                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });



        } else if (x == 11) {

            $.ajax({

                url: "formInsertStaffCountry.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == 12) {

            $.ajax({

                url: "formInsertSallary3.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == 13) {

            $.ajax({

                url: "formInsertjobstaff.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == 14) {

            $.ajax({

                url: "formInsertjobprice.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == 15) {

            $.ajax({

                url: "formInsertjobdesk.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == 16) {

            $.ajax({

                url: "formInsertlembur.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == 17) {

            $.ajax({

                url: "formInserttunjangan.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == 18) {

            $.ajax({

                url: "formInsertLP.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == 19) {

            $.ajax({

                url: "printabsen.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == 20) {

            $.ajax({

                url: "formInsertlemburout.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == 21) {

            $.ajax({

                url: "formInsertLPset.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == 22) {

            $.ajax({

                url: "pembayaran.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == 23) {

            $.ajax({

                url: "formpembayaran.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == 24) {

            $.ajax({

                url: "formEdit_transquo.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == 25) {

            $.ajax({

                url: "formEdit_hotelqo.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == 26) {

            $.ajax({

                url: "form_insert_PT_tour.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == 27) {

            $.ajax({

                url: "update_newlandtour.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == 28) {

            $.ajax({

                url: "insert_newcruise.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == 29) {

            $.ajax({

                url: "form_cruise_ship.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        }


    }

    function insertTransport(x, y, z) {

        $("#divDashboard").hide();

        $("#divReloadPage").show();

        if (x == 0) {

            $.ajax({

                url: "formInsertTransport.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);;

                }

            });

        } else if (x == 1) {

            $.ajax({

                url: "formInsertTransport_Type.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        }



    }

    function reloadPage(x, y, z) {

        $("#divDashboard").hide();

        $("#divReloadPage").show();
        document.getElementById("loading").style.display = "block";

        if (x == 1) {

            $.ajax({

                url: "itinerarytourpackage.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == 2) {

            $.ajax({

                url: "pricetourpackage.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == 3) {

            $.ajax({

                url: "pricedetailtourpackage.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y,
                    tourpricepackage: z
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == 4) {

            $.ajax({

                url: "daylist.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == 0) {

            $.ajax({

                url: "landtour.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });



        } else if (x == -1) {

            $.ajax({

                url: "dashboard.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == -2) {

            $.ajax({

                url: "performaprice.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == -3) {

            $.ajax({

                url: "staff.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == -4) {

            $.ajax({

                url: "country.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == -5) {

            $.ajax({

                url: "city.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == -6) {

            $.ajax({

                url: "inclusion.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == -7) {

            $.ajax({

                url: "exclusion.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == -8) {

            $.ajax({

                url: "remarks.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == -9) {

            $.ajax({

                url: "termsandconditions.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == -10) {

            $.ajax({

                url: "formUploadAgent.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == -11) {

            $.ajax({

                url: "agentfiles.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == -12) {

            $.ajax({

                url: "viewagent.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == -13) {

            $.ajax({

                url: "performapriceAgent2.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == -14) {

            $.ajax({

                url: "performapriceVisaPassport.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });



        } else if (x == -15) {

            $.ajax({

                url: "viewperformapriceAgentPages.php",

                method: "POST",

                asynch: false,

                data: {
                    'id': y,
                    'country': z
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == -16) {

            $.ajax({

                url: "staffcountry.php",

                method: "POST",

                asynch: false,

                data: {
                    'id': y,
                    'country': z
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == -17) {

            $.ajax({

                url: "performapriceFlight.php",

                method: "POST",

                asynch: false,

                data: {
                    'id': y,
                    'country': z
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == -18) {

            $.ajax({

                url: "performapriceFlightGroup.php",

                method: "POST",

                asynch: false,

                data: {
                    'id': y,
                    'country': z
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        }





    }

    function reloadLandtour(x, y, z) {

        $("#divDashboard").hide();

        $("#divReloadPage").show();

        if (x == 0) {

            $.ajax({

                url: "main_tour.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == 1) {

            $.ajax({

                url: "activity_tour.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });
        } else if (x == 2) {

            $.ajax({

                url: "package_tour.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });
        } else if (x == 3) {

            $.ajax({

                url: "form_main_tour.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });
        }
    }

    function reloadcruise(x, y, z) {

        $("#divDashboard").hide();

        $("#divReloadPage").show();

        if (x == 0) {

            $.ajax({

                url: "cruise_activity.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == 1) {

            $.ajax({

                url: "form_activity.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == 2) {

            $.ajax({

                url: "cruise_itin.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == 3) {

            $.ajax({

                url: "formcruise_itin.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == 4) {

            $.ajax({

                url: "formedit_newcruise.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == 5) {

            $.ajax({

                url: "fromedit_itin.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        } else if (x == 6) {

            $.ajax({

                url: "formedit_activity.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y
                },

                success: function(data) {

                    console.log(data)

                    $("#divReloadPage").html(data);

                }

            });

        }
    }

    function Reloaditin(x, y, z) {
        $("#divDashboard").hide();

        $("#divReloadPage").show();
        document.getElementById("loading").style.display = "block";

        if (x == 0) {

            $.ajax({

                url: "itinerary2.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y,
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);

                }

            });
        } else if (x == 1) {

            $.ajax({

                url: "list_itinerary.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y,
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);

                }

            });
        } else if (x == 2) {

            $.ajax({

                url: "excel_itinerary.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y,
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);

                }

            });
        } else if (x == 3) {

            $.ajax({

                url: "preview_itinerary.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y,
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);

                }

            });
        } else if (x == 4) {

            $.ajax({

                url: "make_LT.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y,
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);

                }

            });
        } else if (x == 5) {

            $.ajax({

                url: "list_makeLT.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y,
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);

                }

            });
        } else if (x == 6) {

            $.ajax({

                url: "list_LT_sby.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y,
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);

                }

            });
        } else if (x == 7) {

            $.ajax({

                url: "list_LT_bth.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y,
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);

                }

            });
        } else if (x == 8) {

            $.ajax({

                url: "list_LT_cgk.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y,
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";

                    $("#divReloadPage").html(data);

                }

            });
        } else if (x == 9) {

            $.ajax({

                url: "list_LT_nocode.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y,
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);

                }

            });
        }
    }

    function LT_include(x, y, z) {
        $("#divDashboard").hide();
        $("#divReloadPage").show();
        document.getElementById("loading").style.display = "block";
        if (x == 0) {
            $.ajax({
                url: "LT_include.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                }
            });
        } else if (x == 1) {
            $.ajax({
                url: "LT_add_plane.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                }
            });
        } else if (x == 2) {

            $.ajax({

                url: "LT_perhitungan.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y,
                    cabang: z
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);

                }

            });
        } else if (x == 3) {

            $.ajax({

                url: "LT_add_visa.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y,
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);

                }

            });
        } else if (x == 4) {

            $.ajax({

                url: "LT_add_Tipsguide.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);

                }

            });
        } else if (x == 5) {

            $.ajax({

                url: "LTVS_add_plane.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);

                }

            });
        } else if (x == 6) {

            $.ajax({

                url: "LTVS_add_meal.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);

                }

            });
        } else if (x == 7) {

            $.ajax({

                url: "LTVS_add_hotel.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);

                }

            });
        } else if (x == 8) {

            $.ajax({

                url: "LTVS_add_tips.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);

                }

            });
        }
    }

    function LT_Get_Flight(x, y, z, u) {
        $("#divDashboard").hide();
        $("#divReloadPage").show();
        document.getElementById("loading").style.display = "block";
        if (x == 0) {
            $.ajax({
                url: "LT_add_Transport_byid.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                    grub_id: z,
                    sfee_id: u
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }

            });
        }
    }

    function LT_itinerary(x, y, z) {
        $("#divDashboard").hide();
        $("#divReloadPage").show();
        document.getElementById("loading").style.display = "block";
        if (x == 0) {
            $.ajax({
                url: "LT_List.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (x == 1) {
            $.ajax({
                url: "LT_add_itinerary.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (x == 2) {

            $.ajax({

                url: "LT_add_component.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y,
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();

                }

            });
        } else if (x == 3) {

            $.ajax({

                url: "LT_ListSub.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y,
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();

                }

            });
        } else if (x == 4) {

            $.ajax({

                url: "LT_add_Transport2.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y,
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();

                }

            });
        } else if (x == 5) {
            $.ajax({
                url: "LT_update_itinerary.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (x == 6) {

            $.ajax({

                url: "LT_ListBth.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }

            });
        } else if (x == 7) {

            $.ajax({

                url: "LT_ListCgk.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y,
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();

                }

            });
        } else if (x == 8) {

            $.ajax({

                url: "LT_AH_sub.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y,
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();

                }

            });
        } else if (x == 81) {

            $.ajax({

                url: "LT_AH_NEW.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y,
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();

                }

            });
        } else if (x == 9) {

            $.ajax({

                url: "LT_addHari_component.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y,
                    row: z
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();

                }

            });
        } else if (x == 91) {
            $.ajax({

                url: "LT_AH_list_tmp.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y,
                    row: z
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();

                }
            });
        } else if (x == 92) {
            $.ajax({

                url: "LT_AH_meal.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y,
                    row: z
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();

                }
            });
        } else if (x == 93) {
            $.ajax({

                url: "LT_AH_hotel.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y,
                    row: z
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();

                }
            });
        } else if (x == 10) {

            $.ajax({

                url: "LT_Transport_List.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y,
                    master_id: z,
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();

                }

            });
        } else if (x == 11) {

            $.ajax({

                url: "LT_form_hotel.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y,
                    master_id: z
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();

                }

            });
        } else if (x == 12) {
            $.ajax({
                url: "LT_Perhitungan_List.php",
                method: "POST",
                asynch: false,

                data: {
                    id: y,
                    master_id: z
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();

                }
            });
        } else if (x == 121) {
            $.ajax({
                url: "LT_Perhitungan_List_baru.php",
                method: "POST",
                asynch: false,

                data: {
                    id: y,
                    master_id: z
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();

                }
            });
        } else if (x == 13) {
            $.ajax({
                url: "LTP_add_itinerary.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (x == 14) {
            $.ajax({
                url: "LT_Custom_print.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                    master_id: z
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (x == 15) {
            $.ajax({
                url: "LT_form_mashotel.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (x == 16) {
            $.ajax({
                url: "LT_landtrans_List.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (x == 17) {
            $.ajax({
                url: "LT_Customall_print.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (x == 18) {
            $.ajax({
                url: "LTSUB_update_itinerary.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (x == 19) {

            $.ajax({

                url: "LT_Tgl_List.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y,
                    master_id: z,
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();

                }

            });
        } else if (x == 20) {

            $.ajax({

                url: "LT_add_Transport4.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y,
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();

                }

            });
        } else if (x == 21) {

            $.ajax({

                url: "LT_Flight_optional.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y,
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();

                }

            });
        } else if (x == 22) {

            $.ajax({

                url: "LT_add_Transport_baru.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y,
                    master_id: z
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();

                }

            });
        } else if (x == 23) {

            $.ajax({

                url: "LT_editor_list_tmp.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y,
                    master_id: z
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();

                }

            });
        } else if (x == 24) {

            $.ajax({

                url: "LT_add_Transport_new.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y,
                    master_id: z
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();

                }

            });
        } else if (x == 25) {

            $.ajax({

                url: "LT_Transport_List_new.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y,
                    master_id: z
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();

                }

            });
        } else if (x == 26) {
            $.ajax({
                url: "LT_Customall_print_baru.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (x == 27) {
            $.ajax({
                url: "LT_Master_Package.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (x == 28) {
            $.ajax({
                url: "LT_Master_Meal.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (x == 29) {
            $.ajax({
                url: "LT_Master_Hotel.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (x == 30) {
            $.ajax({
                url: "LT_Master_Opsional.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (x == 31) {
            $.ajax({
                url: "LT_Master_Rute.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (x == 32) {
            $.ajax({
                url: "LT_Master_Tempat.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (x == 33) {
            $.ajax({
                url: "LT_Check_print.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                    master: z,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (x == 34) {
            $.ajax({
                url: "LT_Check_print_dummy.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                    master: z,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (x == 35) {
            $.ajax({
                url: "LT_edit_rute.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                    master: z,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (x == 36) {
            $.ajax({
                url: "LTE_list_tmp.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                    rute_id: z,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (x == 37) {
            $.ajax({
                url: "LT_Landtrans_new.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (x == 38) {
            $.ajax({
                url: "LT_add_image_master.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (x == 39) {

            // $.ajax({

            // 	url: "LT_add_Transport_byid.php",

            // 	method: "POST",

            // 	asynch: false,

            // 	data: {
            // 		id: y,
            // 		grub_id: z,
            // 	},

            // 	success: function(data) {

            // 		$("#divReloadPage").html(data);
            // 		$('.tooltip').remove();
            // 	}

            // });
        } else if (x == 40) {
            $.ajax({
                url: "LT_ListPT.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (x == 41) {
            $.ajax({
                url: "LT_Landtour_Package.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (x == 42) {
            $.ajax({
                url: "form_add_image_itin.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (x == 43) {
            $.ajax({
                url: "LT_Edit_print_master.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else {

        }
    }

    function LT_Package(x, y, z) {
        $("#divDashboard").hide();
        $("#divReloadPage").show();
        document.getElementById("loading").style.display = "block";
        if (x == 0) {
            $.ajax({
                url: "LTP_List_tempat.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (x == 1) {
            $.ajax({
                url: "export_list_tempat.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (x == 2) {

            $.ajax({

                url: "form_edit_tempat.php",

                method: "POST",

                asynch: false,

                data: {
                    id: y,
                },

                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();

                }

            });
        } else if (x == 3) {
            $.ajax({
                url: "LTP_List_landtour.php",
                method: "POST",
                async: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (x == 4) {
            $.ajax({
                url: "LTP_List_flight.php",
                method: "POST",
                async: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (x == 5) {
            $.ajax({
                url: "form_edit_flight.php",
                method: "POST",
                async: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (x == 6) {
            $.ajax({
                url: "form_update_flight.php",
                method: "POST",
                async: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (x == 7) {
            $.ajax({
                url: "form_copy_flight.php",
                method: "POST",
                async: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (x == 8) {
            $.ajax({
                url: "LTP_List_flight_view.php",
                method: "POST",
                async: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (x == 9) {
            $.ajax({
                url: "LTP_Master_Flight.php",
                method: "POST",
                async: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (x == 10) {
            $.ajax({
                url: "LTP_form_route.php",
                method: "POST",
                async: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (x == 11) {
            $.ajax({
                url: "form_master_flight.php",
                method: "POST",
                async: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (x == 12) {
            $.ajax({
                url: "LTP_flight_return.php",
                method: "POST",
                async: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (x == 13) {
            $.ajax({
                url: "LTP_hotel_landtour.php",
                method: "POST",
                async: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (x == 14) {
            $.ajax({
                url: "form_hotel_landtour.php",
                method: "POST",
                async: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (x == 15) {
            $.ajax({
                url: "LTP_Flight_Detail.php",
                method: "POST",
                async: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (x == 16) {
            $.ajax({
                url: "form_delete_fl_detail.php",
                method: "POST",
                async: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (x == 17) {
            $.ajax({
                url: "form_edit_fl_detail.php",
                method: "POST",
                async: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (x == 18) {
            $.ajax({
                url: "form_insert_fl_detail.php",
                method: "POST",
                async: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (x == 19) {
            $.ajax({
                url: "form_copy_fl_detail.php",
                method: "POST",
                async: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (x == 20) {
            $.ajax({
                url: "form_insert_list_tmp.php",
                method: "POST",
                async: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (x == 21) {
            $.ajax({
                url: "form_update_list_tmp.php",
                method: "POST",
                async: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (x == 22) {
            $.ajax({
                url: "LT_Category.php",
                method: "POST",
                async: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (x == 23) {
            $.ajax({
                url: "PT_Website.php",
                method: "POST",
                async: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (x == 24) {
            $.ajax({
                url: "LT_Flight_agent.php",
                method: "POST",
                async: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        }
    }

    function PR_Package(x, y, z) {
        $("#divDashboard").hide();
        $("#divReloadPage").show();
        document.getElementById("loading").style.display = "block";
        if (x == 0) {
            $.ajax({
                url: "PR_Flight.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                }
            });
        } else if (x == 1) {
            $.ajax({
                url: "PR_Flight_Range.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                }
            });

        } else if (x == 2) {
            $.ajax({
                url: "PR_Add_Flight_Range.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                }
            });

        } else if (x == 3) {
            $.ajax({
                url: "PR_LT_Range.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                }
            });

        } else if (x == 4) {
            $.ajax({
                url: "PR_LT.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                }
            });

        } else if (x == 5) {
            $.ajax({
                url: "form_update_profit.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                    z: z
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                }
            });

        } else if (x == 6) {
            $.ajax({
                url: "PR_Add_LT_Range.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                }
            });

        } else if (x == 7) {
            $.ajax({
                url: "form_update_fl_profit.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                    z: z
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                }
            });

        } else if (x == 8) {
            $.ajax({
                url: "PR_Landtrans_range.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                    z: z
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                }
            });
        } else if (x == 9) {
            $.ajax({
                url: "PR_ADD_Landtrans_range.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                    z: z
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                }
            });
        } else if (x == 10) {
            $.ajax({
                url: "PR_Update_Landtrans_range.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                    z: z
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                }
            });
        } else if (x == 11) {
            $.ajax({
                url: "PR_Form_Update_Landtrans_range.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                    z: z
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                }
            });
        }
    }

    function DP_Package(x, y, z) {
        $("#divDashboard").hide();
        $("#divReloadPage").show();
        document.getElementById("loading").style.display = "block";
        if (x == 0) {
            $.ajax({
                url: "DP_master.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                }
            });
        } else if (x == 1) {
            $.ajax({
                url: "DP_ptsub.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                }
            });

        } else if (x == 2) {
            $.ajax({
                url: "DP_ptbth.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                }
            });

        } else if (x == 3) {
            $.ajax({
                url: "DP_ptcgk.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                }
            });

        } else if (x == 5) {
            $.ajax({
                url: "DP_ptsub5.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                }
            });

        }
    }

    function KL_Package(x, y, z) {
        $("#divDashboard").hide();
        $("#divReloadPage").show();
        document.getElementById("loading").style.display = "block";
        if (x == 0) {
            $.ajax({
                url: "KL_bca.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                }
            });
        }
    }

    function OR_Package(x, y, z) {
        $("#divDashboard").hide();
        $("#divReloadPage").show();
        document.getElementById("loading").style.display = "block";
        if (x == 0) {
            $.ajax({
                url: "OR_landtour.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                }
            });
        }
    }

    function FL_Package(x, y, z) {
        $("#divDashboard").hide();
        $("#divReloadPage").show();
        document.getElementById("loading").style.display = "block";
        if (x == 0) {
            $.ajax({
                url: "LT_TR_List.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                }
            });
        }
    }

    function AH_Package(x, y, z, u) {
        $("#divDashboard").hide();
        $("#divReloadPage").show();
        document.getElementById("loading").style.display = "block";
        if (x == 0) {
            $.ajax({
                url: "LT_AH_Baru.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                    grub_id: z,
                    sfee_id: u
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                }
            });
        } else if (x == 1) {
            $.ajax({
                url: "LT_AH_ListTempat.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                    grub_id: z,
                    sfee_id: u
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                }
            });
        } else if (x == 2) {
            $.ajax({
                url: "LT_AH_ListMeal.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                    grub_id: z,
                    sfee_id: u
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                }
            });
        } else if (x == 3) {
            $.ajax({
                url: "LT_AH_ListHotel.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                    grub_id: z,
                    sfee_id: u
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                }
            });
        }
    }

    function OT_Package(x, y, z) {
        $("#divDashboard").hide();
        $("#divReloadPage").show();
        document.getElementById("loading").style.display = "block";
        if (x == 0) {
            $.ajax({
                url: "otorisasi.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                }
            });
        } else if (x == 1) {
            $.ajax({
                url: "joblist_staff_all.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                }
            });
        }
    }

    function MP_Package(x, y, z) {
        $("#divDashboard").hide();
        $("#divReloadPage").show();
        document.getElementById("loading").style.display = "block";
        if (x == 0) {
            $.ajax({
                url: "tokopedia_list.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $('.tooltip').remove();
                    $("#divReloadPage").html(data);
                }
            });
        } else if (x == 1) {
            $.ajax({
                url: "tokoped_rent_list.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $('.tooltip').remove();
                    $("#divReloadPage").html(data);
                }
            });
        } else if (x == 2) {
            $.ajax({
                url: "MP_tokopedia_input_list.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                    z: z
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $('.tooltip').remove();
                    $("#divReloadPage").html(data);
                }
            });
        } else if (x == 3) {
            $.ajax({
                url: "MP_tokopedia_edit.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                    z: z
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $('.tooltip').remove();
                    $("#divReloadPage").html(data);
                }
            });
        } else if (x == 4) {
            $.ajax({
                url: "MP_tokped_rent_input_list.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                    z: z
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $('.tooltip').remove();
                    $("#divReloadPage").html(data);
                }
            });
        } else if (x == 5) {
            $.ajax({
                url: "MP_tokopedia_edit_rent.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                    z: z
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $('.tooltip').remove();
                    $("#divReloadPage").html(data);
                }
            });
        } else if (x == 6) {
            $.ajax({
                url: "tokopedia_land_list.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                    z: z
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $('.tooltip').remove();
                    $("#divReloadPage").html(data);
                }
            });
        } else if (x == 7) {
            $.ajax({
                url: "MP_tokped_land_input_list.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                    z: z
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $('.tooltip').remove();
                    $("#divReloadPage").html(data);
                }
            });
        } else if (x == 8) {
            $.ajax({
                url: "MP_tokopedia_edit_land.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                    z: z
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $('.tooltip').remove();
                    $("#divReloadPage").html(data);
                }
            });
        }
    }

    function TRN_Package(x, y, z) {
        $("#divDashboard").hide();
        $("#divReloadPage").show();
        document.getElementById("loading").style.display = "block";
        if (x == 0) {
            $.ajax({
                url: "TRN_landtrans.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $('.tooltip').remove();
                    $("#divReloadPage").html(data);
                }
            });
        } else if (x == 1) {
            $.ajax({
                url: "TRN_train.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $('.tooltip').remove();
                    $("#divReloadPage").html(data);
                }
            });
        } else if (x == 2) {
            $.ajax({
                url: "TRN_ferry.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $('.tooltip').remove();
                    $("#divReloadPage").html(data);
                }
            });
        } else if (x == 3) {
            $.ajax({
                url: "TRN_landtrans2.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $('.tooltip').remove();
                    $("#divReloadPage").html(data);
                }
            });
        } else if (x == 4) {
            $.ajax({
                url: "TRN_form_landtrans.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $('.tooltip').remove();
                    $("#divReloadPage").html(data);
                }
            });
        } else if (x == 5) {
            $.ajax({
                url: "TRN_form_landtrans_update.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $('.tooltip').remove();
                    $("#divReloadPage").html(data);
                }
            });
        }
    }


    function CT_Package(a, b, c, d) {
        $("#divDashboard").hide();
        $("#divReloadPage").show();
        document.getElementById("loading").style.display = "block";
        if (a == 0) {
            $.ajax({
                url: "custom_page.php",
                method: "POST",
                asynch: false,
                data: {
                    id: b,
                    grub_id: c,
                    sfee_id: d
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $('.tooltip').remove();
                    $("#divReloadPage").html(data);
                }
            });
        } else if (a == 1) {
            $.ajax({
                url: "print_one_page.php",
                method: "POST",
                asynch: false,
                data: {
                    id: b,
                    grub_id: c,
                    sfee_id: d
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $('.tooltip').remove();
                    $("#divReloadPage").html(data);
                }
            });
        } else if (a == 2) {
            $.ajax({
                url: "print_all_page.php",
                method: "POST",
                asynch: false,
                data: {
                    id: b,
                    grub_id: c,
                    sfee_id: d
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $('.tooltip').remove();
                    $("#divReloadPage").html(data);
                }
            });
        } else if (a == 3) {
            $.ajax({
                url: "print_hotel_page.php",
                method: "POST",
                asynch: false,
                data: {
                    id: b,
                    grub_id: c,
                    sfee_id: d
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $('.tooltip').remove();
                    $("#divReloadPage").html(data);
                }
            });
        } else if (a == 4) {
            $.ajax({
                url: "gambar_page.php",
                method: "POST",
                asynch: false,
                data: {
                    id: b,
                    grub_id: c,
                    sfee_id: d
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $('.tooltip').remove();
                    $("#divReloadPage").html(data);

                }
            });
        } else if (a == 5) {
            $.ajax({
                url: "Feetl_Package.php",
                method: "POST",
                asynch: false,
                data: {
                    id: b,
                    grub_id: c,
                    sfee_id: d
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $('.tooltip').remove();
                    $("#divReloadPage").html(data);

                }
            });
        }
    }

    function LT_Get_Judul(a, b, c, d) {
        $("#divDashboard").hide();
        $("#divReloadPage").show();
        document.getElementById("loading").style.display = "block";
        if (a == 0) {
            $.ajax({
                url: "LT_ListPT_update_itinerary.php",
                method: "POST",
                asynch: false,
                data: {
                    id: b,
                    grub_id: c,
                    sfee_id: d
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $('.tooltip').remove();
                    $("#divReloadPage").html(data);
                }
            });
        }
    }


    function MN_Package(x, y, z) {
        $("#divDashboard").hide();
        $("#divReloadPage").show();
        document.getElementById("loading").style.display = "block";
        if (x == 0) {
            $.ajax({
                url: "detail_print.php",
                method: "POST",
                asynch: false,
                data: {
                    id: y,
                    master: z
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $('.tooltip').remove();
                    $("#divReloadPage").html(data);
                }
            });
        }
    }

    function PRN_Package(a, b, c, d) {
        $("#divDashboard").hide();
        $("#divReloadPage").show();
        document.getElementById("loading").style.display = "block";
        if (a == 0) {
            $.ajax({
                url: "print_package.php",
                method: "POST",
                asynch: false,
                data: {
                    id: b,
                    master_id: c,
                    arr: d
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        }
    }

    function LAN_Package(a, b, c) {
        $("#divDashboard").hide();
        $("#divReloadPage").show();
        document.getElementById("loading").style.display = "block";
        if (a == 0) {
            $.ajax({
                url: "LAN_Hotel_List.php",
                method: "POST",
                asynch: false,
                data: {
                    id: b,
                    hotel: c

                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (a == 1) {
            $.ajax({
                url: "rent_transport_new_package.php",
                method: "POST",
                asynch: false,
                data: {
                    id: b
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else {

        }
    }

    function RT_Package(a, b, c, d) {
        $("#divDashboard").hide();
        $("#divReloadPage").show();
        document.getElementById("loading").style.display = "block";
        if (a == 0) {
            $.ajax({
                url: "LT_edit_rute2.php",
                method: "POST",
                asynch: false,
                data: {
                    id: b,
                    grub_id: c,
                    sfee_id: d
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        } else if (a == 1) {
            $.ajax({
                url: "LT_RT_tempat.php",
                method: "POST",
                asynch: false,
                data: {
                    id: b,
                    row_id: c,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        }
    }

    function Meal_Package(a, b, c) {
        $("#divDashboard").hide();
        $("#divReloadPage").show();
        document.getElementById("loading").style.display = "block";
        if (a == 0) {
            $.ajax({
                url: "meal_landtour_package.php",
                method: "POST",
                asynch: false,
                data: {
                    id: b,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        }
    }

    function CS_Package(a, b, c) {
        $("#divDashboard").hide();
        $("#divReloadPage").show();
        document.getElementById("loading").style.display = "block";
        if (a == 0) {
            $.ajax({
                url: "CS_package_list.php",
                method: "POST",
                asynch: false,
                data: {
                    id: b,
                },
                success: function(data) {
                    document.getElementById("loading").style.display = "none";
                    $("#divReloadPage").html(data);
                    $('.tooltip').remove();
                }
            });
        }
    }

    function hideShow(x, y, z) {

        if (x == 1) {

            $("#divDashboard").show();

            $("#divReloadPage").hide();

        }

    }
</script>