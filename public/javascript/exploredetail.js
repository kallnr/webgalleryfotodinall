var segmentTerakhir = window.location.href.split('/').pop();

$.ajax({
    url: window.location.origin +'/explore-detail/'+ segmentTerakhir +'/getdatadetail',
    type: "GET",
    dataType: "JSON",
    success: function(res){
        console.log(res)
        $('#fotodetail').prop('src', '/postingan/'+res.dataDetailFoto.lokasi_file)
        $('#fotoprofil').prop('src', '/pic/'+res.dataDetailFoto.users.foto_profil)
        $('#judulfoto').html(res.dataDetailFoto.judul_foto)
        $('#username').html(res.dataDetailFoto.users.username)
        $('#deksripsifoto').html(res.dataDetailFoto.deksripsi_foto)
        if(res.dataDetailFoto.album_id != null)  $('#album').html(res.dataDetailFoto.album.Nama_Album)
        $('#jumlahpengikut').html(res.dataJumlahFollow.jmlfolow + ' Pengikut')
        ambilKomentar()
        var idUser ;
        if(res.dataFollow == null){
            idUser=""
        } else {
            idUser = res.dataFollow.users_id
        }
        if(res.dataDetailFoto.users_id === res.dataUser){
            $('#tombolfollow').html('')
        } else {
            if(idUser == res.dataUser){
                $('#tombolfollow').html(' <button class="px-4 rounded-full bg-blue-600 text-white" onclick = "ikuti(this, '+res.dataDetailFoto.users_id+')">TidakIkuti</button>')
            } else {
                $('#tombolfollow').html(' <button class="px-4 rounded-full bg-blue-600 text-white" onclick = "ikuti(this, '+res.dataDetailFoto.users_id+')">Ikuti</button>')
            }
        }


    },
    error: function(jqXHR, textStatus, errorThrown){
        alert('gagal')
    }
})


//datakomentar
function ambilKomentar(){
    $.getJSON(window.location.origin +'/explore-detail/getkomen/'+segmentTerakhir, function(res){
        console.log(res)
        if(res.data.lenght === 0){
            $('#komentar').html('<div>Belum ada komentar</div>')
        } else {
            komen= []
            res.data.map((x)=>{
                let datakomentar = {
                    idUser: x.users.id,
                    pengirim: x.users.username,
                    waktu: x.created_at,
                    isikomentar: x.isi_komentar,
                    potopengirim: x.users.foto_profil,
                }
                komen.push(datakomentar);
            })
            tampilkankomentar()
        }
    })
}

//menampilkan komentar
const tampilkankomentar = ()=>{
    $('#komentar').html('')
    komen.map((x, i)=>{
        $('#komentar').append(`
                <article class=" mb-3 text-base">
                    <footer class="flex justify-between items-center mb-2">
                        <div class="flex items-center">
                            <p
                                class="inline-flex items-center mr-3 text-md text-gray-900 dark:text-white font-semibold">
                                <img class="mr-2 w-8 h-8 rounded-full"
                                    src="/pic/${x.potopengirim}"
                                    alt="">${x.pengirim}
                            </p>
                        </div>

                        </div>
                    </footer>
                    <p class="text-gray-500 dark:text-gray-400">${x.isikomentar}</p>


                </article>
        `)

    })

}

//buatkomentar
function kirimkomentar(){
    $.ajax({
        url: window.location.origin +'/explore-detail/kirimkomentar',
        dataType: "JSON",
        type: "POST",
        data: {
            _token: $('input[name="_token"]').val(),
            idfoto: segmentTerakhir,
            isi_komentar: $('input[name="textkomentar"]').val()
        },
        success: function(res){
            $('input[name="textkomentar"]').val('')
        },
        error: function(jqXHR, textStatus, errorThrown){
            alert('gagal mengirim komentar')
        }
    })`
    `
}
// setInterval(ambilKomentar, 500);

// //follow
// function ikuti(txt, idfollow){
//     $.ajax({
//         url: window.location.origin +'/explore-detail/ikuti',
//         dataType: "JSON",
//         type: "POST",
//         data: {
//             _token: $('input[name="_token"]').val(),
//             idfollow: idfollow
//         },
//         success:function(res){
//             location.reload()
//         },
//         error:function(jqXHR, textStatus, errorThrown){
//             alert('gagal')

//         }
//     })
// }
//postinganbawah
var paginate = 1;
var dataExplore = [];
loadMoreData(paginate);
$(window).scroll(function(){
    if($(window).scrollTop() + $(window).height() >= $(document).height()){
        paginate++;
        loadMoreData(paginate);
    }
})
function loadMoreData(paginate){
    $.ajax({
        url: window.location.origin +'/getDataExplore'+ '?page='+paginate,
        type: "GET",
        dataType: "JSON",
        success: function(e){
            console.log(e)
            e.data.data.map((x)=>{
                //Format Tanggal
                var tanggal = x.created_at;
                var tanggalObj = new Date(tanggal);
                var tanggalFormatted = ('0' + tanggalObj.getDate()).slice(-2);
                var bulanFormatted = ('0' + (tanggalObj.getMonth() + 1)).slice(-2);
                var tahunFormatted = tanggalObj.getFullYear();
                var tanggalupload = tanggalFormatted + '-' + bulanFormatted + '-' + tahunFormatted;
                var hasilPencarian = x.likefoto.filter(function(hasil){
                    return hasil.users_id === e.idUser
                })
                if(hasilPencarian.length <= 0){
                    userlike = 0;
                } else {
                    userlike = hasilPencarian[0].users_id;
                }
                let datanya = {
                    id: x.id,
                    judul_foto: x.judul_foto,
                    deksripsi_foto: x.deksripsi_foto,
                    foto: x.lokasi_file,
                    created_at: tanggalupload,
                    Nama_Album : x.album ? x.album.Nama_Album :('-'),
                    username: x.users.username,
                    foto_profil: x.users.foto_profil,
                    jml_komen: x.komenfoto_count,
                    jml_like: x.likefoto_count,
                    idUserLike: userlike,
                    useractive: e.idUser,
                    users_id: x.users_id,
                }
                dataExplore.push(datanya)
                console.log(userlike)
                console.log(e.idUser)
            })
            getExplore()
        },
        error: function(jqXHR, textStatus, errorThrown){

        }

    })
}
//pengulangan data
const getExplore =()=>{
    $('#exploredatapostingan').html('')
    dataExplore.map((x, i)=>{
        $('#exploredatapostingan').append(
            `
            <div class="flex mt-2 bg-white rounded-md shadow-2xl">
                <div class="flex flex-col px-2">
                <a href="/explore-detail/${x.id}">
                        <div class="w-[363px] h-[192px] bg-bgcolor2 overflow-hidden">
                            <img src="/postingan/${x.foto}" class="w-full transition duration-500 ease-in-out hover:scale-105">
                        </div>
                    </a>
                    <div class="flex flex-wrap items-center justify-between px-2 mt-2">
                        <div>
                            <div class="flex flex-col">
                                <div>
                                ${x.judul_foto}
                                </div>
                                <div class="text-xs text-gray-600">
                                ${x.deksripsi_foto}
                                </div>
                            </div>
                        </div>
                        <div>

                        <span class="bi bi-chat-left-text"></span>
                        <small>${x.jml_komen}</small>
                        <span class="bi ${x.idUserLike === x.useractive ? 'bi-heart-fill' : 'bi-heart' }" onclick="likes(this, ${x.id})"></span>
                        <small>${x.jml_like}</small>
                        </div>
                    </div>
                </div>
            </div>
            `
        )
    });
}
//likefoto
function likes(txt, id){
    $.ajax({
        url: window.location.origin +'/likefoto',
        dataType: "JSON",
        type: "POST",
        data: {
            _token: $('input[name="_token"]').val(),
            idfoto: id
        },
        success:function(res){
            console.log(res)
        },
        error:function(jqXHR, textStatus, errorThrown){
            alert('gagal')

        }
    })
}
